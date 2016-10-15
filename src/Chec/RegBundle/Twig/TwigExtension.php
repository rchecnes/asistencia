<?php
namespace Chec\RegBundle\Twig;

use Symfony\Cmf\Bundle\CoreBundle\Templating\Helper\CmfHelper;

class TwigExtension extends \Twig_Extension
{
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

    

    public function getName()
    {
        return 'twig_extension';
    }
}