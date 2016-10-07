<?php

namespace Chec\RegBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Chec\RegBundle\Entity\Asistencia;

/**
 * Asistencia controller.
 *
 * @Route("/asistencia")
 */
class AsistenciaController extends Controller
{
    /**
     * Lists all Asistencia entities.
     *
     * @Route("/", name="asistencia_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();

        $dql   = "SELECT a FROM ChecRegBundle:Asistencia a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render('ChecRegBundle:Asistencia:index.html.twig', array('pagination' => $pagination,
            'title'=>'Listado de Asistencia'));
    }

    /**
     * Finds and displays a Asistencia entity.
     *
     * @Route("/{id}", name="asistencia_show")
     * @Method("GET")
     */
    public function showAction(Asistencia $asistencium)
    {

        return $this->render('asistencia/show.html.twig', array(
            'asistencium' => $asistencium,
        ));
    }
}
