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
        $loginUrl    = $helper->getLoginUrl('http://localhost/asistencia/web/app_dev.php/check_facebook', $permissions);
        
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
    public function loginFacebookAction(Request $request){

        $fb = new Facebook([
          'app_id'     => '1656097854682893',
          'app_secret' => 'ef067760eccd5aaf804137eaa5e168e9',
          'default_graph_version' => 'v2.5',
          'persistent_data_handler'=>'session'
        ]);

        $helper = $fb->getRedirectLoginHelper();

        if (isset($_SESSION['facebook_access_token'])) {

            $accessToken = $_SESSION['facebook_access_token'];

        }else{
            $accessToken = $helper->getAccessToken();

            $_SESSION['facebook_access_token'] = (string) $accessToken;
        }
        

        if (isset($accessToken)) {
            //ld($_REQUEST['code']);
        }

       

        //Obteniendo datos del usuario
        //$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        //$response = $fb->get('/me');
        //$userNode = $response->getGraphUser();

        $response = $fb->get('/me?fields=id,name,work,website,email,first_name,birthday,last_name,picture', $accessToken);
        //ld($response);
        $user = $response->getGraphUser();
        //ld($user->getGeneralInfo());
        echo "<img src='".$user->getPicture()->getUrl()."'></img>";
        //ld('Logged in as ' . $userNode->getName());
        //ld($user);
       
        
    }
}
