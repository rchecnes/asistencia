<?php

namespace Chec\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{

	/**
     *
     * @Route("/login", name="chec_user_login")
     * @Method("GET")
     */
	public function loginAction(Request $request){

		$authenticationUtils = $this->get('security.authentication_utils');

		$error = $authenticationUtils->getLastAuthenticationError();

		//ld($error);

		$lastUsername = $authenticationUtils->getLastUsername();

		return $this->render('ChecUserBundle:Security:login.html.twig',array('last_username'=>$lastUsername,'error'=>$error));

        /*//Nueva forma de atenticacion
        $session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
            ld("Lllega arriba");
        } else {
            ld("Lllega abajo");
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
 
        return $this->render('ChecUserBundle:Security:login.html.twig',array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );*/
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
