<?php

namespace RCH\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RCHUserBundle:Default:index.html.twig');
    }
}
