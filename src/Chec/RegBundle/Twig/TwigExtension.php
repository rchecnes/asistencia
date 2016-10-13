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
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    function restarHora($horaini,$horafin)
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

    public function getAvanceHoras($inicio, $ini_almuerzo, $fin_almuerzo, $salida){

        $mediodia = 0;
        $tarde    = 0;

        if ($inicio != '' && $ini_almuerzo != '') {
            
            $mediodia = $this->restarHora($inicio, $ini_almuerzo);
        }

        if ($fin_almuerzo != '' && $salida != '') {
            
            $tarde = $this->restarHora($fin_almuerzo, $salida);

        }

        return $tarde;
    }

    public function getName()
    {
        return 'twig_extension';
    }
}