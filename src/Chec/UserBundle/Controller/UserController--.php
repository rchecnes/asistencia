<?php

namespace Chec\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    
    /**
     * @Route("/user", name="chec_user_index")
     */
    public function indexAction(Request $request){
    	
    	$em = $this->getDoctrine()->getManager();

    	/*$users = $em->getRepository("ChecUserBundle:User")->findAll();

    	$data['title'] = "Lista de Usuario";
    	$data['users'] = $users;

    	return $this->render('ChecUserBundle:User:index.html.twig',$data);*/

        //$em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT u FROM ChecUserBundle:User u";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        // parameters to template
        return $this->render('ChecUserBundle:User:index.html.twig', array('pagination' => $pagination,
            'title'=>'Listado de Usuarios'));
    }

    /**
     * @Route("/user/add", name="chec_user_add")
     */
    public function addAction(Request $request){
    	echo "holaaa";
    }

    /**
     * @Route("/user/{id}/edit", name="chec_user_edit")
     */
    public function editAction(Request $request, $id){
    	echo "holaaa";
    }

    /**
     * @Route("/user/{id}/view", name="chec_user_view")
     */
    public function viewAction(Request $request, $id){
    	echo "holaaa";
    }

    /**
     *
     * @Route("/user/{id}/delete", name="chec_user_delete")
     * 
     */
    public function deleteAction(Request $request, $id){
    	echo "Articulos:".$page;
    }

}
