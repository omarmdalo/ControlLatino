<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Asociado;
use ModeloBundle\Entity\Tipoasociado;
use ModeloBundle\Entity\Socio;
use ModeloBundle\Form\AsociadoType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Length;


class AsociadoController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    public function indexAction(){
    $asociados = new Asociado();
    $em = $this->getDoctrine()->getEntityManager();
    $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
    $asociados = $asociado_repo->findAll();
    return $this->render("ModeloBundle:Asociado:index.html.twig", array(
                    "asociados" => $asociados
        ));
    }
    public function addAsociadoAction(Request $request) {

        $asociado = new Asociado();
        $form = $this->createForm(AsociadoType::class, $asociado);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
                $asociado = $asociado_repo->findOneBy(array("cedula" => $form->get("cedula")->getData()));
                if (count($asociado) == 0) {
                    $asociado = new Asociado();
                    //Extraer data de formulario
                    $asociado->setNombres($form->get("nombres")->getData());
                    $asociado->setApellidos($form->get("apellidos")->getData());
                    $asociado->setCedula($form->get("cedula")->getData());
                    $asociado->setFecha($form->get("fecha")->getData());
                    $asociado->setIdsocio($form->get("idsocio")->getData());
                    $asociado->setIdtipoasociado($form->get("idtipoasociado")->getData());
                    
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($asociado);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Asociado creado correctamente";
                    } else {
                        $status = "Socio no se registro correctamente";
                    }
                } else {
                    $status = "El Asociado ya existe";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("asociados");
        }


        return $this->render("ModeloBundle:Asociado:add.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    
    public function deleteAsociadoAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
        $asociado = $asociado_repo->find($id);
        $em->remove($asociado);
        $em->flush();
        return $this->redirectToRoute("asociados");
    }
    
    public function updateAsociadoAction(Request $request, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
        $asociado = $asociado_repo->find($id);
        
        $form = $this->createForm(AsociadoType::class, $asociado);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                     
                    //Extraer data de formulario
                    $asociado->setNombres($form->get("nombres")->getData());
                    $asociado->setApellidos($form->get("apellidos")->getData());
                    $asociado->setCedula($form->get("cedula")->getData());
                    $asociado->setFecha($form->get("fecha")->getData());
                    $asociado->setIdsocio($form->get("idsocio")->getData());
                    $asociado->setIdtipoasociado($form->get("idtipoasociado")->getData());
                    
                    $em->persist($asociado);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Asociado Actulizado Correctamente";
                    } else {
                        $status = "Asociado no fue actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("asociados");
        }       
        return $this->render("ModeloBundle:Asociado:update.html.twig", array(
                    "form" => $form->createView()
        ));

        //return $this->redirectToRoute("asociados");
    }
   
}
