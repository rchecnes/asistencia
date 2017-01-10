<?php

namespace Chec\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Facebook\Facebook;

class SecurityController extends Controller
{

	/**
     *
     * @Route("/login", name="chec_user_login")
     * @Method("GET")
     */
	public function loginAction(Request $request){

		$authenticationUtils = $this->get('security.authentication_utils');

		$error               = $authenticationUtils->getLastAuthenticationError();

        $lastUsername        = $authenticationUtils->getLastUsername();

        //Get params facebook
        $fb = new Facebook([
          'app_id'     => '1656097854682893',
          'app_secret' => 'ef067760eccd5aaf804137eaa5e168e9',
          //'default_graph_version' => 'v2.5',
        ]);

        $helper      = $fb->getRedirectLoginHelper();
        $permissions = ['email', 'user_likes']; // optional
        //$permissions = ['email', 'user_likes','publish_actions','user_managed_groups']; // optional
        $loginUrl    = $helper->getLoginUrl('http://localhost:8082/asistencia/web/app_dev.php/check_facebook', $permissions);
        
        $data['last_username'] = $lastUsername;
        $data['error']         = $error;
        $data['url_facebook']  = $loginUrl;


		return $this->render('ChecUserBundle:Security:login.html.twig',$data);

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

    /**
     *
     * @Route("/check_facebook", name="chec_check_facebook")
     * @Method("GET")
     */
    public function checkFacebookAction(Request $request){

        $fb = new Facebook([
          'app_id'     => '1656097854682893',
          'app_secret' => 'ef067760eccd5aaf804137eaa5e168e9',
          //'default_graph_version' => 'v2.5',
          //'persistent_data_handler'=>'session'
        ]);

        $helper = $fb->getRedirectLoginHelper();
       
        if (isset($_SESSION['facebook_access_token'])) {

            $accessToken = $_SESSION['facebook_access_token'];

        }else{
            $accessToken = $helper->getAccessToken();

            $_SESSION['facebook_access_token'] = (string) $accessToken;
        }
        

        if (isset($accessToken)) {
            //Obtenemos datos del usuario
            /*
            $response = $fb->get('/me?fields=id,name,work,website,email,first_name,birthday,last_name,picture', $accessToken);
            //ld($response);
            $user = $response->getGraphUser();
            //ld($user->getGeneralInfo());
            //echo "<img src='".$user->getPicture()->getUrl()."'></img>";
            
            //Registramos el usuario
            $password = $form->get('password')->getData();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $password);

            $obj_rol = $em->getRepository('ChecUserBundle:Rol')->find($form->get('rol')->getData());
            $user->setPassword($encoded);
            $user->setRol($obj_rol);
            $date = date('Y-m-d h:i:s');
            $user->setCreateAt(new \Datetime($date));
            $user->setUpdateAt(new \Datetime($date));
            $user->setPasswordOri($password);

            $em->persist($user);
            $em->flush();

            $message = $this->container->getParameter('massage_sav');
            $request->getSession()->getFlashBag()->add('success', $message);
            //return $this->redirectToRoute('user_show', array('id' => $user->getId()));
            return $this->redirectToRoute('user_index');
            */
        }

       
        //$response = $fb->get('/me?fields=id,name,work,website,email,first_name,birthday,last_name,picture', $accessToken);
        //ld($response);
        //$user = $response->getGraphUser();
        
        //echo "<img src='".$user->getPicture()->getUrl()."'></img>";
       
    }
}
