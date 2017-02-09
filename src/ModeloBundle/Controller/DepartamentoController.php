<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Departamento;
use ModeloBundle\Form\DepartamentoType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Length;


class DepartamentoController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    
    public function indexAction(Request $request){
        
    $em = $this->getDoctrine()->getEntityManager();
    $dql = "SELECT u FROM ModeloBundle:Departamento u ORDER BY u.nombre ASC";
    $query = $em->createQuery($dql);

    $paginator = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
            $query, $request->query->getInt('page', 1), 10
    );

    return $this->render("ModeloBundle:Departamento:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }
    
    public function addDepartamentoAction(Request $request) {

        $departamento = new Departamento();
        $form = $this->createForm(DepartamentoType::class, $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $departamento_repo = $em->getRepository("ModeloBundle:Departamento");

                //Extraer data de formulario
                $departamento->setNombre($form->get("nombre")->getData());
                $departamento->setDescripcion($form->get("descripcion")->getData());
                
                $em->persist($departamento);
                $flush = $em->flush();

                if ($flush == null) {
                    $status = "Departamento creado correctamente";
                } else {
                    $status = "Departamento no ha sido creado";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("departamentos");
        }


        return $this->render("ModeloBundle:Departamento:add.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    
    public function deleteDepartamentoAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $departamento_repo = $em->getRepository("ModeloBundle:Departamento");
        $departamento = $departamento_repo->find($id);
        $em->remove($departamento);
        $flush = $em->flush();
        if ($flush == null) {
            $status = "Departamento Eliminado";
        } else {
            $status = "Departamento no ha sido Eliminado";
        }          
        $this->session->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("departamentos");
    }
    
    public function updateDepartamentoAction(Request $request, $id){
        
        
        $em = $this->getDoctrine()->getEntityManager();
        $departamento_repo = $em->getRepository("ModeloBundle:Departamento");
        $departamento = $departamento_repo->find($id);
                
        $form = $this->createForm(DepartamentoType::class, $departamento);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    $departamento->setNombre($form->get("nombre")->getData());
                    $departamento->setDescripcion($form->get("descripcion")->getData());
                                                                            
                    $em->persist($departamento);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Departamento Actulizado Correctamente";
                    } else {
                        $status = "Departamento no ha sido actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("departamentos");
        }       
        return $this->render("ModeloBundle:Departamento:update.html.twig", array(
                    "form" => $form->createView()
        ));

        //return $this->redirectToRoute("asociados");
    }
    
   public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        
        $search = $request->query->get("search", null);
        
        if( $search == NULL){
            $this->redirect($this->generateUrl("departamentos"));            
        }
        
        $dql = "SELECT u FROM ModeloBundle:Departamento u "
                . "WHERE u.nombre LIKE :search "              
                . "ORDER BY u.nombre ASC";
        
        $query = $em->createQuery($dql)->setParameter('search', "%$search%");

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page', 1), 10
        );
        

        return $this->render("ModeloBundle:Departamento:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }
   
}
