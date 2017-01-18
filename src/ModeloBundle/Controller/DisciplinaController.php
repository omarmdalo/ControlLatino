<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Disciplina;
use ModeloBundle\Form\DisciplinaType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Length;


class DisciplinaController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    
    public function indexAction(){
    $disciplinas = new Disciplina();
    $em = $this->getDoctrine()->getEntityManager();
    $disciplina_repo = $em->getRepository("ModeloBundle:Disciplina");
    $disciplinas = $disciplina_repo->findAll();
    return $this->render("ModeloBundle:Disciplina:index.html.twig", array(
                    "disciplinas" => $disciplinas
        ));
    }
    
    public function addDisciplinaAction(Request $request) {

        $disciplina = new Disciplina();
        $form = $this->createForm(DisciplinaType::class, $disciplina);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $disciplina_repo = $em->getRepository("ModeloBundle:Disciplina");

                $disciplina = new Disciplina();
                //Extraer data de formulario
                $disciplina->setNombre($form->get("nombre")->getData());
                $disciplina->setDescripcion($form->get("descripcion")->getData());
                $disciplina->setLugar($form->get("lugar")->getData());
             
                
                $em->persist($disciplina);
                $flush = $em->flush();

                if ($flush == null) {
                    $status = "Disciplina creada correctamente";
                } else {
                    $status = "Disciplina no ha sido creada";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("disciplinas");
        }


        return $this->render("ModeloBundle:Disciplina:add.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    
    public function deleteDisciplinaAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $disciplina_repo = $em->getRepository("ModeloBundle:Disciplina");
        $disciplina = $disciplina_repo->find($id);
        $em->remove($disciplina);
        $flush = $em->flush();
        if ($flush == null) {
            $status = "Disciplina Eliminada";
        } else {
            $status = "Disciplina no ha sido Eliminada";
        }          
        $this->session->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("disciplinas");
    }
    
    public function updateDisciplinaAction(Request $request, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $disciplina_repo = $em->getRepository("ModeloBundle:Disciplina");
        $disciplina = $disciplina_repo->find($id);
        

        $form = $this->createForm(DisciplinaType::class, $disciplina);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    $disciplina->setNombre($form->get("nombre")->getData());
                    $disciplina->setDescripcion($form->get("descripcion")->getData());
                    $disciplina->setLugar($form->get("lugar")->getData());
                                                                             
                    $em->persist($disciplina);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Disciplina Actulizada Correctamente";
                    } else {
                        $status = "Disciplina no ha sido actualizada";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("disciplinas");
        }       
        return $this->render("ModeloBundle:Disciplina:update.html.twig", array(
                    "form" => $form->createView()
        ));

        //return $this->redirectToRoute("asociados");
    }
   
}
