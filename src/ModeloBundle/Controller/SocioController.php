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

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $dql = "SELECT u FROM ModeloBundle:Socio u ORDER BY u.accion";
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page', 1), 10
        );
        
//    $em = $this->getDoctrine()->getEntityManager();
//    $socio_repo = $em->getRepository("ModeloBundle:Socio");
//    $socios = $socio_repo->findAll();

        return $this->render("ModeloBundle:Socio:index.html.twig", array(
                    "pagination" => $pagination
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
                $codigo = "";
                if (count($socio) == 0) {

                    $socio = new Socio();
                    //Datos del Socio
                    $socio->setNombres($form->get("nombres")->getData());
                    $socio->setApellidos($form->get("apellidos")->getData());
                    $socio->setCedula($form->get("cedula")->getData());
                    $socio->setNacimiento($form->get("nacimiento")->getData());
                    $socio->setRazonSocial($form->get("razonSocial")->getData());
                    $socio->setRif($form->get("rif")->getData());
                    
                    //Fecha Registro y ultima actualizacion 
                    $socio->setRegistro(new \DateTime("now"));
                    $socio->setActualizado(new \DateTime("now"));
                            
                    //Fecha Registro y ultima actualizacion
                    $socio->setEmision(null);
                    $socio->setVencimiento(null);        
                    
                  

                    //Generamos Codigo de Barras (Repositorio Asociados)                 
                    $codigo = $socio_repo->GenerarCodigo($form->get("accion")->getData());
                    $socio->setCodigo($codigo);
                    //Guardamos codigo de barra carnetizacion anterior
                    $socio->setOld($form->get("old")->getData());

                    //Guardamos numero de accion de contrato
                    $socio->setAccion($form->get("accion")->getData());
                    
                    //Estado de ingreso
                    $socio->setSolvente($form->get("solvente")->getData());
                    
                    //Imagen Perfil
                    $file = $form["imagen"]->getData();
                    if (!empty($file) && $file != null) {
                        $file = $form["imagen"]->getData();
                        $ext = $file->guessExtension();
                        $file_name = $form->get("cedula")->getData() . time() . "." . $ext;
                        $file->move("uploads/socios", $file_name);
                        $socio->setImagen($file_name);
                    } else {
                        $socio->setImagen(null);
                    }

                    //Guardamos Tipo de Socio
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

    public function deleteSocioAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $socio_repo = $em->getRepository("ModeloBundle:Socio");
        $socio = $socio_repo->find($id);
        $em->remove($socio);
        $flush = $em->flush();
        if ($flush == null) {
            $status = "Socio Eliminado";
        } else {
            $status = "Socio no ha sido Eliminado";
        } 
        return $this->redirectToRoute("socios");
    }

    public function updateSocioAction(Request $request, $id) {
        $em = $this->getDoctrine()->getEntityManager();
        $socio_repo = $em->getRepository("ModeloBundle:Socio");
        $socio = $socio_repo->find($id);

        $per_imagen = $socio->getImagen();

        $form = $this->createForm(SocioType::class, $socio);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                //Datos del Socio
                $socio->setNombres($form->get("nombres")->getData());
                $socio->setApellidos($form->get("apellidos")->getData());
                $socio->setCedula($form->get("cedula")->getData());
                $socio->setNacimiento($form->get("nacimiento")->getData());
                $socio->setRazonSocial($form->get("razonSocial")->getData());
                $socio->setRif($form->get("rif")->getData());
                
                //Fecha Registro y ultima actualizacion 
                $socio->setActualizado(new \DateTime("now"));
                
                //Codigo de barra carnetizacion anterior
                $socio->setOld($form->get("old")->getData());
                
                //Guardamos numero de accion de contrato
                $socio->setAccion($form->get("accion")->getData());
                    
                //Estado de ingreso
                $socio->setSolvente($form->get("solvente")->getData());

                //Imagen Perfil
                $file = $form["imagen"]->getData();
                if (!empty($file) && $file != null) {
                    $file = $form["imagen"]->getData();
                    $ext = $file->guessExtension();
                    $file_name = $form->get("cedula")->getData() . time() . "." . $ext;
                    $file->move("uploads/socios", $file_name);
                    $socio->setImagen($file_name);
                } else {
                    $socio->setImagen($per_imagen);
                }

                //Tipo de Socio
                $socio->setIdtiposocio($form->get("idtiposocio")->getData());


                $em->persist($socio);
                $flush = $em->flush();

                if ($flush == null) {
                    $status = "Socio Actulizado Correctamente";
                } else {
                    $status = "Socio no fue actualizado";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("socios");
        }
        return $this->render("ModeloBundle:Socio:update.html.twig", array(
                    "form" => $form->createView()
        ));

    }

    public function detailSocioAction($id) {
        $socio = new Socio();
        $em = $this->getDoctrine()->getEntityManager();
        $socio_repo = $em->getRepository("ModeloBundle:Socio");
        $socio = $socio_repo->find($id);
        return $this->render("ModeloBundle:Socio:detail.html.twig", array(
                    "socio" => $socio
        ));
    }
    
    
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        
        $search = $request->query->get("search", null);
        
        if( $search == NULL){
            $this->redirect($this->generateUrl("socios"));            
        }
        
        $dql = "SELECT u FROM ModeloBundle:Socio u "
                . "WHERE u.nombres LIKE :search "
                . "OR u.apellidos LIKE :search "
                . "OR u.cedula LIKE :search "
                . "OR u.accion LIKE :search "
                . "OR u.codigo LIKE :search "
                . "OR u.old LIKE :search "
                . "ORDER BY u.accion ASC";
        
        $query = $em->createQuery($dql)->setParameter('search', "%$search%");

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page', 1), 10
        );
        
//    $em = $this->getDoctrine()->getEntityManager();
//    $socio_repo = $em->getRepository("ModeloBundle:Socio");
//    $socios = $socio_repo->findAll();

        return $this->render("ModeloBundle:Socio:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }

}
