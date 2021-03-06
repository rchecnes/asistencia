<?php

namespace Chec\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Chec\UserBundle\Entity\User;
use Chec\UserBundle\Form\UserType;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        //$user = $this->container->get('security.context')->getToken()->getUser();
        //ld($user);exit();
        $em = $this->getDoctrine()->getManager();
        
        $dql   = "SELECT u FROM ChecUserBundle:User u";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        // parameters to template
        return $this->render('ChecUserBundle:User:index.html.twig', array('pagination' => $pagination,
            'title'=>'Listado de Usuarios'));
    }

    /**
     * Creates a new User entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {   

        $user = new User();
        $form = $this->createForm('Chec\UserBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

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
        }

        return $this->render('ChecUserBundle:User:new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'title'=>'Nuevo Usuario'
        ));
    }

	/**
     * Creates a new User entity.
     *
     * @Route("/newanonimo", name="user_new_anonimo")
     * @Method({"GET", "POST"})
     */
    public function newAnonimoAction(Request $request)
    {   

        $user = new User();
        $form = $this->createForm('Chec\UserBundle\Form\UserAnonimoType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $password = $form->get('password')->getData();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $password);

            $obj_rol = $em->getRepository('ChecUserBundle:Rol')->find(2);
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
            return $this->redirectToRoute('chec_user_login');
        }

        return $this->render('ChecUserBundle:User:newAnonimo.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'title'=>'Nuevo Usuario'
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('ChecUserBundle:User:show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('Chec\UserBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $imagen = $editForm->get('url_image');
            ld($imagen);
            exit();

            $em = $this->getDoctrine()->getManager();

            $password = $editForm->get('password')->getData();
            $encoder  = $this->container->get('security.password_encoder');
            $encoded  = $encoder->encodePassword($user, $password);

            $obj_rol = $em->getRepository('ChecUserBundle:Rol')->find($editForm->get('rol')->getData());
            $user->setPassword($encoded);
            $user->setRol($obj_rol);
            $date = date('Y-m-d h:i:s');
            $user->setUpdateAt(new \Datetime($date));
            $user->setPasswordOri($password);

            $em->persist($user);
            $em->flush();

            $message = $this->container->getParameter('massage_upd');
            $request->getSession()->getFlashBag()->add('success', $message);

            return $this->redirectToRoute('user_index');
        }

        return $this->render('ChecUserBundle:User:edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'title'=>'Editar Usuario'
        ));
    }

    /**
     * Deletes a User entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a User entity.
     *
     * @param User $user The User entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
