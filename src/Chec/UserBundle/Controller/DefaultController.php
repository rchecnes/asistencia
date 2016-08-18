<?php

namespace Chec\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ChecUserBundle:Default:index.html.twig');
    }
}
