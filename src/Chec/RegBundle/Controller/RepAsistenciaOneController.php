<?php

namespace Chec\RegBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RepAsistenciaOneController extends Controller
{
    /**
     * Lists all Asistencia entities.
     *
     * @Route("/regasistencia", name="reporte_asistencia_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();

        /*$dateact = date('Y-m-d');
        $dql     = "SELECT a FROM ChecRegBundle:Asistencia a ORDER BY a.create_at DESC";
        $query   = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, // query NOT result 
            $request->query->getInt('page', 1)//page number,
            5//limit per page
        );
        */
        
        $data['title']      = 'Reporte de Asistencia Gráfico';
        //$data['pagination'] = $pagination;
    
        return $this->render('ChecRegBundle:RepAsistenciaOne:index.html.twig', $data);
    }
}
