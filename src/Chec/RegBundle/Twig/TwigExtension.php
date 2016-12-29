<?php
namespace Chec\RegBundle\Twig;

use Symfony\Cmf\Bundle\CoreBundle\Templating\Helper\CmfHelper;
use Symfony\Component\HttpFoundation\Request;

class TwigExtension extends \Twig_Extension
{
    private $conn;
    private $em;
    private $url_base;

    public function __construct()
    {
        $this->em       = $GLOBALS['kernel']->getContainer()->get('doctrine')->getManager();
        $this->conn     = $GLOBALS['kernel']->getContainer()->get('database_connection');
        //$this->url_base = $GLOBALS['kernel']->getContainer()->get('request')->getBaseUrl();
        $this->url_base='';
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }

    public function getFunctions()
    {
        return array(
            'getAvanceHoras'  => new \Twig_Function_Method($this, 'getAvanceHoras'),
            'getPorcentajeAvance'  => new \Twig_Function_Method($this, 'getPorcentajeAvance'),
            'getMenuXRol'  => new \Twig_Function_Method($this, 'getMenuXRol'),
            'getMenu'  => new \Twig_Function_Method($this, 'getMenu'),
        );

        
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    private function restarHora($horaini,$horafin)
    {
        $horai=substr($horaini,0,2);
        $mini=substr($horaini,3,2);
        $segi=substr($horaini,6,2);
     
        $horaf=substr($horafin,0,2);
        $minf=substr($horafin,3,2);
        $segf=substr($horafin,6,2);
     
        $ini=((($horai*60)*60)+($mini*60)+$segi);
        $fin=((($horaf*60)*60)+($minf*60)+$segf);
     
        $dif=$fin-$ini;
     
        $difh=floor($dif/3600);
        $difm=floor(($dif-($difh*3600))/60);
        $difs=$dif-($difm*60)-($difh*3600);
        return date("H:i:s",mktime($difh,$difm,$difs));
    }

    private function parteHora( $hora ){
        $horaSplit = explode(":", $hora);
            if( count($horaSplit) < 3 ){
                $horaSplit[2] = 0;
            }
        return $horaSplit;
    }
    private function SumaHoras( $time1, $time2 ){
            list($hour1, $min1, $sec1) = $this->parteHora($time1);
            list($hour2, $min2, $sec2) = $this->parteHora($time2);
            return date('H:i:s', mktime( $hour1 + $hour2, $min1 + $min2, $sec1 + $sec2));
    }

    public function getAvanceHoras($inicio, $ini_almuerzo, $fin_almuerzo, $salida){

        $mediodia = '';
        $tarde    = '';

        if ($inicio != '' && $ini_almuerzo != '') {
            
            $mediodia = $this->restarHora($inicio, $ini_almuerzo);
        }

        if ($fin_almuerzo != '' && $salida != '') {
            
            $tarde = $this->restarHora($fin_almuerzo, $salida);

        }

        if ($mediodia != '' && $tarde == '') {

            return $mediodia; 

        }elseif($mediodia == '' && $tarde != ''){

            return $tarde;

        }elseif($mediodia != '' && $tarde != ''){

            return $this->SumaHoras($mediodia, $tarde);

        }

        
    }

    public function getPorcentajeAvance($hora){

        //segundos a trabajar
        if ($hora != '') {

            list($horas_i, $minutos_i, $segundos_i) = explode(':', '08:00:00');
            $hora_en_segundos_i = ($horas_i * 3600 ) + ($minutos_i * 60 ) + $segundos_i;

            //segundos trabajados
            list($horas_e, $minutos_e, $segundos_e) = explode(':', $hora);
            $hora_en_segundos_e = ($horas_e * 3600 ) + ($minutos_e * 60 ) + $segundos_e;
            
            return number_format(($hora_en_segundos_e*100)/$hora_en_segundos_i,2);
            
        }else{

            return 0;
        }
        
    }

    public function getMenuXRol($padre=0)
    {
        $sql = "SELECT * FROM menu WHERE padre=$padre";
        $resp = $this->conn->executeQuery($sql)->fetchAll();

        if(empty($resp)){return "";}
        $menu = "";
        foreach ($resp as $key => $row) {

            if ($row['tiene_hijo'] == 0) {
                $enlace = ($row['enlace'] !='')?$row['enlace']:'#';
                $menu .= "<li>";
                $menu .= "<a href='".$this->url_base."/".$enlace."'>";
                $menu .= "<i class='menu-icon fa fa-cogs fa-4x'></i><span class='menu-text'>".$row['nombre']."</span>";
                $menu .= "</a>";
                $menu .= "</li>";

            }else{
                $menu .= "<li>";
                $menu .= "<a href='#' class='dropdown-toggle'>";
                $menu .= "<i class='menu-icon fa fa-cogs fa-4x'></i><span class='menu-text'>".$row['nombre']."</span>";
                $menu .= "<b class='arrow fa fa-angle-down'></b>";
                $menu .= "</a>";
                $menu .= $this->getMenuXRol($row['id']);
                $menu .= "</li>";
            }
        }

        if ($padre ==0) {
            $menu="<ul class='nav nav-list'>$menu</ul>";
        }else{
            $menu="<ul class='submenu nav-show'>$menu</ul>";
        }
        

        //if($padre==0){$menu="<div id='menu_cab'>$menu</div>";}
        if($padre==0){$menu=$menu;}
        
        return $menu;
    }

    public function getMenu($padre=0)
    {
        $sql = "SELECT * FROM menu WHERE padre=$padre AND estado=1";
        $resp = $this->conn->executeQuery($sql)->fetchAll();

        if(empty($resp)){return "";}
        $menu = "";
        foreach ($resp as $key => $row) {

            if ($row['tiene_hijo'] == 0) {
                $menu .= "<li>";
                $menu .= "<a href='#' id='".$row['id']."' name='".$row['id']."'>";
                $menu .= "<i class='fa  fa-file-code-o fa-4x'></i><span class='menu-text'>".$row['nombre']."</span>";
                $menu .= "</a>";
                $menu .= "</li>";

            }else{
                $menu .= "<li>";
                $menu .= "<a href='#' id='".$row['id']."' name='".$row['id']."' class='dropdown-toggle'>";
                $menu .= "<i class='fa  fa-folder-open-o fa-4x'></i><span class='menu-text'>".$row['nombre']."</span>";
                $menu .= "<b class='arrow fa fa-plus'></b>";
                $menu .= "</a>";
                $menu .= $this->getMenu($row['id']);
                $menu .= "</li>";
            }
        }

        if ($padre ==0) {
            $menu="<ul class=''>$menu</ul>";
        }else{
            $menu="<ul class=''>$menu</ul>";
        }
        

        //if($padre==0){$menu="<div id='menu_cab'>$menu</div>";}
        if($padre==0){$menu=$menu;}
        
        return $menu;
    }

    public function getName()
    {
        return 'twig_extension';
    }
}