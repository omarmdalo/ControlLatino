<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Asociado;
use ModeloBundle\Entity\Socio;
use ModeloBundle\Entity\Empleado;
use ModeloBundle\Entity\Familiar;
use ModeloBundle\Form\CardAsociadoType;
use ModeloBundle\Form\CardSocioType;
use ModeloBundle\Form\CardEmpleadoType;
use ModeloBundle\Form\CardFamiliarType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Length;


class CardController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
              
    public function updateCardAsociadoAction(Request $request, $id){
       
        $em = $this->getDoctrine()->getEntityManager();
        $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
        $asociado = $asociado_repo->find($id);
        $form = $this->createForm(CardAsociadoType::class, $asociado);        
        $form->handleRequest($request);        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    //Fecha de Emision y Vencimiento Carnet
                    $asociado->setEmision($form->get("emision")->getData());
                    $asociado->setVencimiento($form->get("vencimiento")->getData());                   
                    //Hora Actualizacion
                    $asociado->setActualizacion(new \DateTime("now"));
                                         
                    $em->persist($asociado);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Carnet Actualizado Correctamente";
                    } else {
                        $status = "Carnet no fue actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("asociados");
        }       
        return $this->render("ModeloBundle:Carnet:update.html.twig", array(
                    "form" => $form->createView(),
                    "datos" => $asociado
        ));

    }
    
        public function updateCardSocioAction(Request $request, $id){
       
        $em = $this->getDoctrine()->getEntityManager();
        $socio_repo = $em->getRepository("ModeloBundle:Socio");
        $socio = $socio_repo->find($id);
        $form = $this->createForm(CardSocioType::class, $socio);        
        $form->handleRequest($request);        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    //Fecha de Emision y Vencimiento Carnet
                    $socio->setEmision($form->get("emision")->getData());
                    $socio->setVencimiento($form->get("vencimiento")->getData());                   
                    //Hora Actualizacion
                    $socio->setActualizado(new \DateTime("now"));
                                         
                    $em->persist($socio);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Carnet Actualizado Correctamente";
                    } else {
                        $status = "Carnet no fue actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("socios");
        }       
        return $this->render("ModeloBundle:Carnet:update.html.twig", array(
                    "form" => $form->createView(),
                    "datos" => $socio
        ));

    }

    public function updateCardEmpleadoAction(Request $request, $id){
       
        $em = $this->getDoctrine()->getEntityManager();
        $empleado_repo = $em->getRepository("ModeloBundle:Empleado");
        $empleado = $empleado_repo->find($id);
        $form = $this->createForm(CardEmpleadoType::class, $empleado);        
        $form->handleRequest($request);        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    //Fecha de Emision y Vencimiento Carnet
                    $empleado->setEmision($form->get("emision")->getData());
                    $empleado->setVencimiento($form->get("vencimiento")->getData());                   
                    //Hora Actualizacion
                    $empleado->setActualizacion(new \DateTime("now"));
                                         
                    $em->persist($empleado);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Carnet Actualizado Correctamente";
                    } else {
                        $status = "Carnet no fue actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("empleados");
        }       
        return $this->render("ModeloBundle:Carnet:update.html.twig", array(
                    "form" => $form->createView(),
                    "datos" => $empleado
        ));

    }

    public function updateCardFamiliarAction(Request $request, $id){
       
        $em = $this->getDoctrine()->getEntityManager();
        $familiar_repo = $em->getRepository("ModeloBundle:Familiar");
        $familiar = $familiar_repo->find($id);
        $form = $this->createForm(CardFamiliarType::class, $familiar);        
        $form->handleRequest($request);        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    //Fecha de Emision y Vencimiento Carnet
                    $familiar->setEmision($form->get("emision")->getData());
                    $familiar->setVencimiento($form->get("vencimiento")->getData());                   
                    //Hora Actualizacion
                    $familiar->setActualizacion(new \DateTime("now"));
                                         
                    $em->persist($familiar);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Carnet Actualizado Correctamente";
                    } else {
                        $status = "Carnet no fue actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("familiar");
        }       
        return $this->render("ModeloBundle:Carnet:update.html.twig", array(
                    "form" => $form->createView(),
                    "datos" => $familiar
        ));

    }

    
}
