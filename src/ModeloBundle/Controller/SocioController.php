<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Socio;
use ModeloBundle\Entity\Tiposocio;
use ModeloBundle\Form\SocioType;
use Symfony\Component\HttpFoundation\Session\Session;


class SocioController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    public function indexAction(){
    $socios = new Socio();
    $em = $this->getDoctrine()->getEntityManager();
    $socio_repo = $em->getRepository("ModeloBundle:Socio");
    $socios = $socio_repo->findAll();
    return $this->render("ModeloBundle:Socio:index.html.twig", array(
                    "socios" => $socios
        ));
    }
    public function addSocioAction(Request $request) {

        $socio = new Socio();
        $form = $this->createForm(SocioType::class, $socio);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $socio_repo = $em->getRepository("ModeloBundle:Socio");
                $socio = $socio_repo->findOneBy(array("cedula" => $form->get("cedula")->getData()));
                $codigo="";
                if (count($socio) == 0) {
            
                    $socio = new Socio();
                    //Extraer data de formulario
                    $socio->setNombres($form->get("nombres")->getData());
                    $socio->setApellidos($form->get("apellidos")->getData());
                    $socio->setCedula($form->get("cedula")->getData());
                    $socio->setRazonSocial($form->get("razonSocial")->getData());
                    $socio->setRif($form->get("rif")->getData());
                    $socio->setFecha(new \DateTime("now"));
                    
                    //Generamos Codigo de Barras (Repositorio Asociados)                 
                    $codigo=$socio_repo->GenerarCodigo($form->get("accion")->getData());

                    $socio->setCodigo($codigo);
                    $socio->setOld($form->get("old")->getData());
                    
                    //Imagen Perfil
                    $file=$form["imagen"]->getData();
                    if(!empty($file) && $file!=null){
                    $file=$form["imagen"]->getData();
                    $ext=$file->guessExtension();
                    $file_name=$form->get("cedula")->getData().time().".".$ext;
                    $file->move("uploads/socios",$file_name);                    
                    $socio->setImagen($file_name);
                    }else
                        {
                        $socio->setImagen(null);
                        }
                    
                    $socio->setAccion($form->get("accion")->getData());
                    $socio->setSolvente($form->get("solvente")->getData());
                    $socio->setIdtiposocio($form->get("idtiposocio")->getData());
                    
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($socio);
                    $flush = $em->flush();

                    if ($flush == null) {
                        
                        $status = "Socio creado correctamente";
                    } else {
                        $status = "Socio no se registro correctamente";
                    }
                } else {
                    $status = "El socio ya existe";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("socios");
        }


        return $this->render("ModeloBundle:Socio:add.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    
    public function deleteSocioAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $socio_repo = $em->getRepository("ModeloBundle:Socio");
        $socio = $socio_repo->find($id);
        $em->remove($socio);
        $em->flush();
        return $this->redirectToRoute("socios");
    }
    
    public function updateSocioAction(Request $request, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $socio_repo = $em->getRepository("ModeloBundle:Socio");
        $socio = $socio_repo->find($id);
        
        $per_imagen= $socio->getImagen();
        
        $form = $this->createForm(SocioType::class, $socio);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                    //Extraer data de formulario
                    $socio->setNombres($form->get("nombres")->getData());
                    $socio->setApellidos($form->get("apellidos")->getData());
                    $socio->setCedula($form->get("cedula")->getData());
                    $socio->setRazonSocial($form->get("razonSocial")->getData());
                    $socio->setRif($form->get("rif")->getData());
                                        
                    $socio->setOld($form->get("old")->getData());
                    
                    
                    //Imagen Perfil
                    $file=$form["imagen"]->getData();
                    if(!empty($file) && $file!=null){
                    $file=$form["imagen"]->getData();
                    $ext=$file->guessExtension();
                    $file_name=$form->get("cedula")->getData().time().".".$ext;
                    $file->move("uploads/socios",$file_name);                    
                    $socio->setImagen($file_name);
                    }else
                        {
                        $socio->setImagen($per_imagen);
                        }
                    
                    $socio->setAccion($form->get("accion")->getData());
                    $socio->setSolvente($form->get("solvente")->getData());
                    $socio->setIdtiposocio($form->get("idtiposocio")->getData());


                    $em->persist($socio);
                    $flush = $em->flush();
                    
                    if ($flush == null) {
                        $status = "Socio Actulizado Correctamente";
                    } else {
                        $status = "Socio no fue actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("socios");
        }       
        return $this->render("ModeloBundle:Socio:update.html.twig", array(
                    "form" => $form->createView()
        ));

        //return $this->redirectToRoute("asociados");
    }
    
    public function detailSocioAction($id){
    $socio = new Socio();
    $em = $this->getDoctrine()->getEntityManager();
    $socio_repo = $em->getRepository("ModeloBundle:Socio");
    $socio = $socio_repo->find($id);
    return $this->render("ModeloBundle:Socio:detail.html.twig", array(
                    "socio" => $socio
        ));
    }

}
