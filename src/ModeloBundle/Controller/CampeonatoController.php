<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Campeonato;
use ModeloBundle\Entity\Jugador;
use ModeloBundle\Form\CampeonatoType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Length;


class CampeonatoController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    
    public function indexAction(){
    $campeonatos = new Campeonato();
    $em = $this->getDoctrine()->getEntityManager();
    $campeonato_repo = $em->getRepository("ModeloBundle:Campeonato");
    $campeonatos = $campeonato_repo->findAll();
    return $this->render("ModeloBundle:Campeonato:index.html.twig", array(
                    "campeonatos" => $campeonatos
        ));
    }
    
    public function addCampeonatoAction(Request $request) {

        $campeonato = new Campeonato();
        $form = $this->createForm(CampeonatoType::class, $campeonato);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $campeonato_repo = $em->getRepository("ModeloBundle:Campeonato");

                $campeonato = new Campeonato();
                //Extraer data de formulario
                $campeonato->setNombre($form->get("nombre")->getData());
                $campeonato->setDescripcion($form->get("descripcion")->getData());
                $campeonato->setIddisciplina($form->get("iddisciplina")->getData());
                
                $em->persist($campeonato);
                $flush = $em->flush();

                if ($flush == null) {
                    $status = "Campeonato creado correctamente";
                } else {
                    $status = "Campeonato no ha sido creado";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("campeonatos");
        }


        return $this->render("ModeloBundle:Campeonato:add.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    
    public function deleteCampeonatoAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $campeonato_repo = $em->getRepository("ModeloBundle:Campeonato");
        $campeonato = $campeonato_repo->find($id);
        $em->remove($campeonato);
        $flush = $em->flush();
        if ($flush == null) {
            $status = "Campeonato Eliminado";
        } else {
            $status = "Campeonato no ha sido Eliminado";
        }          
        $this->session->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("campeonatos");
    }
    
    public function updateCampeonatoAction(Request $request, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $campeonato_repo = $em->getRepository("ModeloBundle:Campeonato");
        $campeonato = $campeonato_repo->find($id);
        

        $form = $this->createForm(CampeonatoType::class, $campeonato);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    $campeonato->setNombre($form->get("nombre")->getData());
                    $campeonato->setDescripcion($form->get("descripcion")->getData());
                    $campeonato->setIddisciplina($form->get("iddisciplina")->getData());
                                                                             
                    $em->persist($campeonato);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Campeonato Actulizado Correctamente";
                    } else {
                        $status = "Campeonato no ha sido actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("campeonatos");
        }       
        return $this->render("ModeloBundle:Campeonato:update.html.twig", array(
                    "form" => $form->createView()
        ));

        //return $this->redirectToRoute("asociados");
    }
    
    public function detailCampeonatoAction($id){
    $campeonato = new Campeonato();
    $em = $this->getDoctrine()->getEntityManager();
    $campeonato_repo = $em->getRepository("ModeloBundle:Campeonato");
    $campeonato = $campeonato_repo->find($id);
    
    
    
    return $this->render("ModeloBundle:Campeonato:detail.html.twig", array(
                    "campeonato" => $campeonatos//,
                    //"jugadores" => $jugadores,
                    //"equipos" => $equipos,
                    //"partidos" => $partidos
        ));
    }
   
}
