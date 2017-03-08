<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Familiar;
use ModeloBundle\Form\FamiliarType;
use ModeloBundle\Form\FamiliarSocioType;
use ModeloBundle\Form\FamiliarAsociadoType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Length;


class FamiliarController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    
    public function indexAction(Request $request){
        
    $em = $this->getDoctrine()->getEntityManager();
    $dql = "SELECT u FROM ModeloBundle:Familiar u ORDER BY u.nombres ASC";
    $query = $em->createQuery($dql);

    $paginator = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
            $query, $request->query->getInt('page', 1), 10
    );    
    return $this->render("ModeloBundle:Familiar:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }
    
    public function addFamiliarAction(Request $request, $relacion, $id) {
        
        //Carga de formulario socio o asociado
        $familiar = new Familiar();
        $form = $this->createForm(FamiliarType::class, $familiar);
        
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $familiar = new Familiar();
                $em = $this->getDoctrine()->getEntityManager();
                $familiar_repo = $em->getRepository("ModeloBundle:Familiar");
                $num_familiar = $familiar_repo->findBy(array("cedula" => $form->get("cedula")->getData()));                
                $codigo="";

                if (count($num_familiar) == 0 || $form->get("cedula")->getData() == null ) {
                    //Extraer data de formulario
                    $familiar->setNombres($form->get("nombres")->getData());
                    $familiar->setApellidos($form->get("apellidos")->getData());
                    $familiar->setCedula($form->get("cedula")->getData());
                    $familiar->setNacimiento($form->get("nacimiento")->getData());
                    
                    //Calcular la Edad
                    $edad = $familiar_repo->CalcularEdad($form->get("nacimiento")->getData(), new \DateTime("now"));
                    $familiar->setEdad($edad);
                    
                    //Hora Registro y Actualizacion
                    $familiar->setRegistro(new \DateTime("now"));
                    $familiar->setActualizacion(new \DateTime("now"));

                    
                    //Generamos Codigo de Barras (Repositorio Familiar)                 
                    $codigo=$familiar_repo->GenerarCodigo($id, $relacion, $form->get("idtipofamiliar")->getData());                   
                    $familiar->setCodigo($codigo);
                    
                    //Fecha de Emision y Vencimiento Carnet (default=null)
                    $familiar->setEmision(null);
                    $familiar->setVencimiento(null);
                    
                    //Permitir Ingreso
                    $familiar->setSolvente($form->get("solvente")->getData());
 
                    //Carga de Imagen de Perfil
                    $file=$form["imagen"]->getData();
                    if(!empty($file) && $file!=null){
                    $file=$form["imagen"]->getData();
                    $ext=$file->guessExtension();
                    $file_name=$form->get("cedula")->getData().time().".".$ext;
                    $file->move("uploads/familiar",$file_name);                    
                    $familiar->setImagen($file_name);
                    }else
                        {
                        $familiar->setImagen(null);
                        }
                    
                    //Guardamos Tipo de Familiar
                    $familiar->setIdtipofamiliar($form->get("idtipofamiliar")->getData());    
                        
                    //Relacion con el #Socio    
                    if($relacion == 1){
                        $socio_repo = $em->getRepository("ModeloBundle:Socio");
                        $socio = $socio_repo->findOneBy(array("id"=>$id));
                        $familiar->setIdsocio($socio);
                        $familiar->setIdasociado(null);                           
                    }elseif($relacion == 2){
                        $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
                        $asociado = $asociado_repo->findOneBy(array("id"=>$id));
                        $familiar->setIdsocio(null);
                        $familiar->setIdasociado($asociado);
                    }
                    
                 
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($familiar);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Familiar creado correctamente";
                    } else {
                        $status = "Familiar no se registro correctamente";
                    }
                } else {
                    $status = "El Familiar ya existe";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("familiar");
        }


        return $this->render("ModeloBundle:Familiar:add.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    
    public function deleteAsociadoAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
        $asociado = $asociado_repo->find($id);
        $em->remove($asociado);
        $flush = $em->flush();
        if ($flush == null) {
            $status = "Asociado Eliminado";
        } else {
            $status = "Asociado no ha sido Eliminado";
        } 
        return $this->redirectToRoute("asociados");
    }
    
    public function updateFamiliarAction(Request $request, $relacion, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $familiar_repo = $em->getRepository("ModeloBundle:Familiar");
        $familiar = $familiar_repo->find($id);
        
        $per_imagen= $familiar->getImagen();
        if($relacion == 1){
            $form = $this->createForm(FamiliarSocioType::class, $familiar); 
        }elseif($relacion == 2){
            $form = $this->createForm(FamiliarAsociadoType::class, $familiar); 
        }
        
        
        $form->handleRequest($request); 
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                    //Extraer data de formulario
                    $familiar->setNombres($form->get("nombres")->getData());
                    $familiar->setApellidos($form->get("apellidos")->getData());
                    $familiar->setCedula($form->get("cedula")->getData());
                    $familiar->setNacimiento($form->get("nacimiento")->getData());
                    
                    //Calcular la Edad
                    $edad = $familiar_repo->CalcularEdad($form->get("nacimiento")->getData(), new \DateTime("now"));
                    $familiar->setEdad($edad);
                    
                    //Hora Registro y Actualizacion
                    $familiar->setActualizacion(new \DateTime("now"));
                    
                   
                    //Permitir Ingreso
                    $familiar->setSolvente($form->get("solvente")->getData());
                    
                    //subida de imagen
                    $file=$form["imagen"]->getData();
                    if(!empty($file) && $file!=null){
                        $file=$form["imagen"]->getData();
                        $ext=$file->guessExtension();
                        $file_name=$form->get("cedula")->getData().time().".".$ext;
                        $file->move("uploads",$file_name);                    
                        $familiar->setImagen($file_name);
                    }else
                        {
                        $familiar->setImagen($per_imagen);
                        }
                        
                     //Guardamos Tipo de Familiar
                    $familiar->setIdtipofamiliar($form->get("idtipofamiliar")->getData());    
                    
                     //Relacion con el #Socio    
                    if($relacion == 1){   
                       $familiar->setIdsocio($form->get("idsocio")->getData());                          
                    }elseif($relacion == 2){
                        $familiar->setIdasociado($form->get("idasociado")->getData());
                    }
                    
                    $em->persist($familiar);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Familiar Actulizado Correctamente";
                    } else {
                        $status = "Familiar no fue actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("familiar");
        }       
        return $this->render("ModeloBundle:Familiar:update.html.twig", array(
                    "form" => $form->createView(),
                    "relacion" => $relacion
        ));

        //return $this->redirectToRoute("asociados");
    }
   
    public function detailAsociadoAction($id){
    $asociado = new Asociado();
    $em = $this->getDoctrine()->getEntityManager();
    $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
    $asociado = $asociado_repo->find($id);
    return $this->render("ModeloBundle:Asociado:detail.html.twig", array(
                    "asociado" => $asociado
        ));
    }
    
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        
        $search = $request->query->get("search", null);
        
        if( $search == NULL){
            $this->redirect($this->generateUrl("familiar"));            
        }
        
        $dql = "SELECT u FROM ModeloBundle:Familiar u "
                . "WHERE u.nombres LIKE :search "
                . "OR u.apellidos LIKE :search "
                . "OR u.cedula LIKE :search "
                . "OR u.codigo LIKE :search "
                . "ORDER BY u.codigo ASC";
        
        $query = $em->createQuery($dql)->setParameter('search', "%$search%");

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page', 1), 10
        );
        
        return $this->render("ModeloBundle:Familiar:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }
}
