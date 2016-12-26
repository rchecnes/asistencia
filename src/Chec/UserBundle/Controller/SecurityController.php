<?php

namespace Chec\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

	/**
     *
     * @Route("/", name="chec_user_login")
     * @Method("GET")
     */
	public function loginAction(Request $request){

		$authenticationUtils = $this->get('security.authentication_utils');

		$error = $authenticationUtils->getLastAuthenticationError();

		$lastUsername = $authenticationUtils->getLastUsername();

		return $this->render('ChecUserBundle:Security:login.html.twig',array('last_username'=>$lastUsername,'error'=>$error));
	}

	/**
     *
     * @Route("/login_check", name="chec_user_login_check")
     * @Method("POST")
     */
	public function loginCheckAction(){

	}

	/**
     *
     * @Route("/logout", name="chec_user_logout")
     * @Method("GET")
     */
	public function logoutAction(Request $request){

		$session = $request->getSession();

    	$session->invalidate(); //here we can now clear the session.
	}
}
