<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Socio;
use ModeloBundle\Entity\Ficha;
use ModeloBundle\Form\FichaType;
use Symfony\Component\HttpFoundation\Session\Session;


class FichaController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    public function indexAction(){
    $fichas = new Ficha();
    $em = $this->getDoctrine()->getEntityManager();
    $ficha_repo = $em->getRepository("ModeloBundle:Ficha");
    $fichas = $ficha_repo->findAll();
    return $this->render("ModeloBundle:Ficha:index.html.twig", array(
                    "fichas" => $fichas
        ));
    }
    
    public function addFichaAction(Request $request) {

        $ficha = new Ficha();
        $form = $this->createForm(FichaType::class, $ficha);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $ficha = new Ficha();
                $em = $this->getDoctrine()->getEntityManager();

                
                //Extraer data de formulario
                $ficha->setMotivo($form->get("motivo")->getData());
                //$ficha->setFecha($form->get("fecha")->getData());
                $ficha->setFecha(new \DateTime("now"));
                //Extraemos Usuario Activo
                $user=$this->getUser();
                $ficha->setIdusuario($user);
                
                $ficha->setIdsocio($form->get("idsocio")->getData());               
                //Insertamos la ficha
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($ficha);
                $flush = $em->flush();
                
                $ficha_repo = $em->getRepository("ModeloBundle:Ficha");
                $ficha_repo->saveFichaInvitados(
                        $form->get("invitados")->getData(),
                        $form->get("motivo")->getData(),
                        $form->get("idsocio")->getData(),
                        $user
                        );
                              
                if ($flush == null) {
                    $status = "Ficha creada correctamente";
                } else {
                    $status = "Ficha no se registro correctamente";
                }               
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("fichas");
        }


        return $this->render("ModeloBundle:Ficha:add.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    
    public function deleteFichaAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $ficha_repo = $em->getRepository("ModeloBundle:Ficha");
        $ficha = $ficha_repo->find($id);
        
        $invitado_ficha_repo = $em->getRepository("ModeloBundle:InvitadoFicha");
        $invitado_ficha = $invitado_ficha_repo->findBy(array("idficha"=>$ficha));
        
        
        $em->remove($ficha);
        $em->flush();
        return $this->redirectToRoute("fichas");
    }
    
    public function updateFichaAction(Request $request, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $ficha_repo = $em->getRepository("ModeloBundle:Ficha");
        $ficha = $ficha_repo->find($id);
        
        $form = $this->createForm(FichaType::class, $ficha);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $ficha = new Ficha();
                $em = $this->getDoctrine()->getEntityManager();

                
                //Extraer data de formulario
                $ficha->setMotivo($form->get("motivo")->getData());
                //$ficha->setFecha($form->get("fecha")->getData());
                $ficha->setFecha(new \DateTime("now"));
                //Extraemos Usuario Activo
                $user=$this->getUser();
                $ficha->setIdusuario($user);
                
                $ficha->setIdsocio($form->get("idsocio")->getData());               
                //Insertamos la ficha
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($ficha);
                $flush = $em->flush();
                
                $ficha_repo = $em->getRepository("ModeloBundle:Ficha");
                $ficha_repo->saveFichaInvitados(
                        $form->get("invitados")->getData(),
                        $form->get("motivo")->getData(),
                        $form->get("idsocio")->getData(),
                        $user
                        );
                              
                if ($flush == null) {
                    $status = "Ficha creada correctamente";
                } else {
                    $status = "Ficha no se registro correctamente";
                }               
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("fichas");
        }      
                return $this->render("ModeloBundle:Ficha:update.html.twig", array(
                    "form" => $form->createView()
        ));

        //return $this->redirectToRoute("asociados");
    }
   
}
