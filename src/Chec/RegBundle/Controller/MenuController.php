<?php

namespace Chec\RegBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Chec\RegBundle\Entity\Menu;
use Symfony\Component\HttpFoundation\Response;


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
        
        $data['title'] = 'Menú Del Sistema';
        $data['menu']  = $this->getMenuPadre();

        return $this->render('ChecRegBundle:Menu:index.html.twig', $data);
    }

    public function getMenuPadre(){
        
        $em = $this->getDoctrine()->getManager();

        $dql = $em->getRepository('ChecRegBundle:Menu')->findBy(array('estado'=>1,'padre'=>0));

        $menu = '';

        foreach ($dql as $key => $m) {

            if ($m->getTieneHijo() == 1) {

                $menu .= '<li id="item_'.$m->getId().'"><a href="#" id="link_'.$m->getId().'" class="padre">';
                $menu .= '<i class="ace-icon fa fa-circle"></i>';
                $menu .= '<span>'.$m->getNombre().'</span>';
                $menu .= '</a></li>';
            }else{

                $menu .= '<li id="item_'.$m->getId().'">';
                $menu .= '<i class="ace-icon fa fa-circle-o"></i>';
                $menu .= '<span>'.$m->getNombre().'</span>';
                $menu .= '</li>';
            }
        }

        return $menu;
    }

    /**
     * Lists all Menu entities.
     *
     * @Route("/menuhijo", name="menu_hijo")
     * @Method("POST | GET")
     */
    public function getHijoAction(Request $resquest){

        //$padre = $resquest->request()->get('padre');
        
        //$em    = $this->getDoctrine()->getManager();
        $conn = $this->get('database_connection');

        //$dql   = $em->getRepository('ChecRegBundle:Menu')->findBy(array('estado'=>1,'padre'=>$padre));
        $sql = "SELECT * FROM menu WHERE estado=1";
        $resp = $conn->executeQuery($sql)->fetchAll();

        $data = array();

        foreach ($resp as $key => $m) {
            $data[] = $m;
        }

        $response = new JsonResponse();
        $response->setData($data);

        return $response;
    }

    /*public function getMenu($padre=0)
    {   
        $conn = $this->get('database_connection');

        $sql = "SELECT * FROM menu WHERE padre=$padre AND estado=1";
        $resp = $conn->executeQuery($sql)->fetchAll();

        if(empty($resp)){return "";}
        $menu = "";
        foreach ($resp as $key => $row) {

            if ($row['tiene_hijo'] == 0) {
                $menu .= "<li>";
                $menu .= "<a href='#' id='".$row['id']."' name='".$row['id']."'>";
                $menu .= "<i class='fa  fa-file-code-o fa-4x'></i><span class='menu-text'>".$row['nombre']."</span>";
                $menu .= "</a>";
                $menu .= "</li>";

            }else{
                $menu .= "<li>";
                $menu .= "<a href='#' id='".$row['id']."' name='".$row['id']."' class='dropdown-toggle'>";
                $menu .= "<i class='fa  fa-folder-open-o fa-4x'></i><span class='menu-text'>".$row['nombre']."</span>";
                $menu .= "<b class='arrow fa fa-plus'></b>";
                $menu .= "</a>";
                $menu .= $this->getMenu($row['id']);
                $menu .= "</li>";
            }
        }

        if ($padre ==0) {
            $menu="<ul class=''>$menu</ul>";
        }else{
            $menu="<ul class=''>$menu</ul>";
        }

        if($padre==0){$menu=$menu;}
        
        return $menu;
    }*/

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
