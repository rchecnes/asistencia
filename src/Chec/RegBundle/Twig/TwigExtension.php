<?php
namespace Chec\RegBundle\Twig;

use Symfony\Cmf\Bundle\CoreBundle\Templating\Helper\CmfHelper;

class TwigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        /*return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
            new \Twig_SimpleFilter('saludo', array($this, 'saludo')),
        );*/
        /*return array(
            'saludo' => new Twig_Filter_Function('saludo'),
        );*/

        /*return array(
            'saludo'  => new \Twig_Filter_Method($this, 'saludo'),
        );*/
    }

    public function getFunctions()
    {
        return array(
            'saludo' => new \Twig_SimpleFunction('asset', 'Functions::saludo')
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    public function saludo($saludo){
        return $saludo;
    }

    public function getName()
    {
        return 'twig_extension';
    }
}