<?php

namespace Chec\RegBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Chec\RegBundle\Entity\Menu;

/**
 * Menu controller.
 *
 * @Route("/menu")
 */
class MenuController extends Controller
{
    /**
     * Lists all Menu entities.
     *
     * @Route("/", name="menu_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        /*$em = $this->getDoctrine()->getManager();

        $menus = $em->getRepository('ChecRegBundle:Menu')->findAll();

        return $this->render('menu/index.html.twig', array(
            'menus' => $menus,
        ));*/

        return $this->render('ChecRegBundle:Menu:index.html.twig', array('title'=>'Menú Del Sistema'));
    }

    /**
     * Finds and displays a Menu entity.
     *
     * @Route("/{id}", name="menu_show")
     * @Method("GET")
     */
    public function showAction(Menu $menu)
    {

        return $this->render('menu/show.html.twig', array(
            'menu' => $menu,
        ));
    }
}
