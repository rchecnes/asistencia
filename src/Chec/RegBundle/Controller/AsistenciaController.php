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

        $dateact = date('Y-m-d');
        $dql     = "SELECT a FROM ChecRegBundle:Asistencia a ORDER BY a.create_at DESC";
        $query   = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        //ld($dateact);

        return $this->render('ChecRegBundle:Asistencia:index.html.twig', array('pagination' => $pagination,
            'title'=>'Listado de Asistencia',
            'dateact'=>$dateact));
    }

    /**
     * Registrar asistencia.
     *
     * @Route("/registrarasistencia", name="asistencia_registrar_asistencia")
     */
    public function gegistrarAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();

        

        $time = date('H:i:s');
        $date = date('Y-m-d');

        
        $date = new \Datetime($date);
        //echo $date;

        $object = $em->getRepository('ChecRegBundle:Asistencia')->findBy(array('create_at'=>$date));

        $asist = new Asistencia();

        if (isset($object[0]) ){
            
           

           $asisexis = $em->getRepository('ChecRegBundle:Asistencia')->find($object[0]->getId());
           
           $ingreso = $asisexis->getIngreso();
           $inialmuerzo = $asisexis->getIniAlmuerzo();
           $finalmuerso = $asisexis->getFinAlmuerzo();

           if ($ingreso) {
               $asisexis->setIniAlmuerzo(new \Datetime($time));
           }

           if ($inialmuerzo) {
               $asisexis->setFinAlmuerzo(new \Datetime($time));
           }

           if ($finalmuerso) {
               $asisexis->setSalida(new \Datetime($time));
           }

            $em->persist($asisexis);
            $em->flush();
        }else{
            $asist->setCreateAt($date);
            $asist->setUpdateAt($date);
            $asist->setIngreso(new \Datetime($time));

            $em->persist($asist);
            $em->flush();
        }
        
        
        
        return $this->redirect($this->generateUrl('asistencia_index'));
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
