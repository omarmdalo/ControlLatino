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
    public function indexAction(Request $request){
        
    $em = $this->getDoctrine()->getEntityManager();
    $dql = "SELECT u FROM ModeloBundle:Asociado u ORDER BY u.codigo ASC";
    $query = $em->createQuery($dql);

    $paginator = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
            $query, $request->query->getInt('page', 1), 5
    );    
    return $this->render("ModeloBundle:Asociado:index.html.twig", array(
                    "pagination" => $pagination
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
                $num_aso = 0;
                $codigo="";
                $num_aso = $asociado_repo->findAll();
                if (count($asociado) == 0) {
                    $asociado = new Asociado();
                    //Extraer data de formulario
                    $asociado->setNombres($form->get("nombres")->getData());
                    $asociado->setApellidos($form->get("apellidos")->getData());
                    $asociado->setCedula($form->get("cedula")->getData());
                    $asociado->setNacimiento($form->get("nacimiento")->getData());
                                        
                    //Hora Registro y Actualizacion
                    $asociado->setFecha(new \DateTime("now"));
                    $asociado->setActualizacion(new \DateTime("now"));
                    
                    //Generamos Codigo de Barras (Repositorio Asociados)                 
                    $codigo=$asociado_repo->GenerarCodigo($form->get("idsocio")->getData());                   
                    $asociado->setCodigo($codigo);
                    
                    //Fecha de Emision y Vencimiento Carnet (default=null)
                    $asociado->setEmision(null);
                    $asociado->setVencimiento(null);
                    
                    //Permitir Ingreso
                    $asociado->setSolvente($form->get("solvente")->getData());
                    
                    //Numero de Asociado
                    $asociado->setNumasociado((count($num_aso))+1);
                    
                    //Carga de Imagen de Perfil
                    $file=$form["imagen"]->getData();
                    if(!empty($file) && $file!=null){
                    $file=$form["imagen"]->getData();
                    $ext=$file->guessExtension();
                    $file_name=$form->get("cedula")->getData().time().".".$ext;
                    $file->move("uploads",$file_name);                    
                    $asociado->setImagen($file_name);
                    }else
                        {
                        $asociado->setImagen(null);
                        }
                        
                    //Relacion con el #Socio    
                    $asociado->setIdsocio($form->get("idsocio")->getData());
                    
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
        $flush = $em->flush();
        if ($flush == null) {
            $status = "Asociado Eliminado";
        } else {
            $status = "Asociado no ha sido Eliminado";
        } 
        return $this->redirectToRoute("asociados");
    }
    
    public function updateAsociadoAction(Request $request, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
        $asociado = $asociado_repo->find($id);
        
        $per_imagen= $asociado->getImagen();
        
        
        $form = $this->createForm(AsociadoType::class, $asociado);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    $asociado->setNombres($form->get("nombres")->getData());
                    $asociado->setApellidos($form->get("apellidos")->getData());
                    $asociado->setCedula($form->get("cedula")->getData());
                    $asociado->setNacimiento($form->get("nacimiento")->getData());
                    
                    //Hora Actualizacion
                    $asociado->setActualizacion(new \DateTime("now"));
                    
                    //Permitir Ingreso
                    $asociado->setSolvente($form->get("solvente")->getData());
                    
                    //subida de imagen
                    $file=$form["imagen"]->getData();
                    if(!empty($file) && $file!=null){
                        $file=$form["imagen"]->getData();
                        $ext=$file->guessExtension();
                        $file_name=$form->get("cedula")->getData().time().".".$ext;
                        $file->move("uploads",$file_name);                    
                        $asociado->setImagen($file_name);
                    }else
                        {
                        $asociado->setImagen($per_imagen);
                        }
                    $asociado->setIdsocio($form->get("idsocio")->getData());
                                        
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
            $this->redirect($this->generateUrl("asociados"));            
        }
        
        $dql = "SELECT u FROM ModeloBundle:Asociado u "
                . "WHERE u.nombres LIKE :search "
                . "OR u.apellidos LIKE :search "
                . "OR u.cedula LIKE :search "
                . "OR u.codigo LIKE :search "
                . "ORDER BY u.codigo ASC";
        
        $query = $em->createQuery($dql)->setParameter('search', "%$search%");

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page', 1), 5
        );
        
        return $this->render("ModeloBundle:Asociado:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }
}
