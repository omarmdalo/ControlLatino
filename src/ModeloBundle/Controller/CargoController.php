<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Cargo;
use ModeloBundle\Form\CargoType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Length;


class CargoController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    
    public function indexAction(Request $request){
        
    $em = $this->getDoctrine()->getEntityManager();
    $dql = "SELECT u FROM ModeloBundle:Cargo u ORDER BY u.nombre ASC";
    $query = $em->createQuery($dql);

    $paginator = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
            $query, $request->query->getInt('page', 1), 10
    );

    return $this->render("ModeloBundle:Cargo:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }
    
    public function addCargoAction(Request $request) {

        $cargo = new Cargo();
        $form = $this->createForm(CargoType::class, $cargo);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $cargo_repo = $em->getRepository("ModeloBundle:Cargo");

                //Extraer data de formulario
                $cargo->setNombre($form->get("nombre")->getData());
                $cargo->setDescripcion($form->get("descripcion")->getData());
                $cargo->setIddepartamento($form->get("iddepartamento")->getData());
                
                $em->persist($cargo);
                $flush = $em->flush();

                if ($flush == null) {
                    $status = "Cargo creado correctamente";
                } else {
                    $status = "Cargo no ha sido creado";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("cargos");
        }


        return $this->render("ModeloBundle:Cargo:add.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    
    public function deleteCargoAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $cargo_repo = $em->getRepository("ModeloBundle:Cargo");
        $cargo = $cargo_repo->find($id);
        $em->remove($cargo);
        $flush = $em->flush();
        if ($flush == null) {
            $status = "Cargo Eliminado";
        } else {
            $status = "Cargo no ha sido Eliminado";
        }          
        $this->session->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("cargos");
    }
    
    public function updateCargoAction(Request $request, $id){
        
        
        $em = $this->getDoctrine()->getEntityManager();
        $cargo_repo = $em->getRepository("ModeloBundle:Cargo");
        $cargo = $cargo_repo->find($id);
                
        $form = $this->createForm(CargoType::class, $cargo);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    $cargo->setNombre($form->get("nombre")->getData());
                    $cargo->setDescripcion($form->get("descripcion")->getData());
                                    $cargo->setIddepartamento($form->get("iddepartamento")->getData());
                                                                            
                    $em->persist($cargo);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Cargo Actulizado Correctamente";
                    } else {
                        $status = "Cargo no ha sido actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("cargos");
        }       
        return $this->render("ModeloBundle:Cargo:update.html.twig", array(
                    "form" => $form->createView()
        ));

        //return $this->redirectToRoute("asociados");
    }
    
   public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        
        $search = $request->query->get("search", null);
        
        if( $search == NULL){
            $this->redirect($this->generateUrl("cargos"));            
        }
        
        $dql = "SELECT u FROM ModeloBundle:Cargos u "
                . "WHERE u.nombre LIKE :search "              
                . "ORDER BY u.nombre ASC";
        
        $query = $em->createQuery($dql)->setParameter('search', "%$search%");

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page', 1), 10
        );
        

        return $this->render("ModeloBundle:Cargo:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }
   
}
