<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Equipo;
use ModeloBundle\Entity\JugadorEquipo;
use ModeloBundle\Form\EquipoType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Length;


class EquipoController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    
    public function indexAction(){
    $equipos = new Equipo();
    $em = $this->getDoctrine()->getEntityManager();
    $equipos_repo = $em->getRepository("ModeloBundle:Equipo");
    $equipos = $equipos_repo->findAll();
    return $this->render("ModeloBundle:Equipo:index.html.twig", array(
                    "equipos" => $equipos
        ));
    }
    
    public function addEquipoAction(Request $request) {

        $equipo = new Equipo();
        $form = $this->createForm(EquipoType::class, $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();                

                $equipo = new Equipo();
                //Extraer data de formulario
                $equipo->setNombre($form->get("nombre")->getData());
                $equipo->setDescripcion($form->get("descripcion")->getData());
                $equipo->setIdcampeonato($form->get("idcampeonato")->getData());
                
                $em->persist($equipo);
                $flush = $em->flush();

                if ($flush == null) {
                    $status = "Equipo creado correctamente";
                } else {
                    $status = "Equipo no ha sido creado";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("equipos");
        }


        return $this->render("ModeloBundle:Equipo:add.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    
    public function deleteEquipoAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $equipo_repo = $em->getRepository("ModeloBundle:Equipo");
        $equipo = $equipo_repo->find($id);
        $em->remove($equipo);
        $flush = $em->flush();
        if ($flush == null) {
            $status = "Equipo Eliminado";
        } else {
            $status = "Equipo no ha sido Eliminado";
        }          
        $this->session->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("equipos");
    }
    
    public function updateEquipoAction(Request $request, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $equipo_repo = $em->getRepository("ModeloBundle:Equipo");
        $equipo = $equipo_repo->find($id);
        

        $form = $this->createForm(EquipoType::class, $equipo);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    $equipo->setNombre($form->get("nombre")->getData());
                    $equipo->setDescripcion($form->get("descripcion")->getData());
                    $equipo->setIdcampeonato($form->get("idcampeonato")->getData());
                                                                             
                    $em->persist($equipo);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Equipo Actulizado Correctamente";
                    } else {
                        $status = "Equipo no ha sido actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("equipos");
        }       
        return $this->render("ModeloBundle:Equipo:update.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    public function detailEquipoAction($id){
    $equipo = new Equipo();
    $em = $this->getDoctrine()->getEntityManager();
    $equipo_repo = $em->getRepository("ModeloBundle:Equipo");
    $equipo = $equipo_repo->find($id);
    
    $jugadorequipo_repo = $em->getRepository("ModeloBundle:JugadorEquipo");
    $jugadores = $jugadorequipo_repo->findBy(array("idequipo" => $id));

    
    return $this->render("ModeloBundle:Equipo:detail.html.twig", array(
                    "equipo" => $equipo,
                    "jugadores" => $jugadores//,
                    //"equipos" => $equipos,
                    //"partidos" => $partidos
        ));
    }
   
}
