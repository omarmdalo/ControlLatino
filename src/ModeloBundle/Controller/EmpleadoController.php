<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Empleado;
use ModeloBundle\Form\EmpleadoType;
use Symfony\Component\HttpFoundation\Session\Session;

class EmpleadoController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $dql = "SELECT u FROM ModeloBundle:Empleado u ORDER BY u.nombres ASC";
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page', 1), 10
        );

        return $this->render("ModeloBundle:Empleado:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }

    public function addEmpleadoAction(Request $request) {

        $empleado = new Empleado();
        $form = $this->createForm(EmpleadoType::class, $empleado);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $empleado_repo = $em->getRepository("ModeloBundle:Empleado");
                $empleado = $empleado_repo->findOneBy(array("cedula" => $form->get("cedula")->getData()));
                $codigo = "";
                $edad =0;
                if (count($empleado) == 0) {

                    $empleado = new Empleado();
                    //Datos del Empleado
                    $empleado->setNombres($form->get("nombres")->getData());
                    $empleado->setApellidos($form->get("apellidos")->getData());
                    $empleado->setCedula($form->get("cedula")->getData());
                    $empleado->setNacimiento($form->get("nacimiento")->getData());
                    
                    //Calculamos la edad
                    $edad = $empleado_repo->CalcularEdad($form->get("nacimiento")->getData(), new \DateTime("now"));
                    $empleado->setEdad($edad);

                    
                    //Fecha Registro y ultima actualizacion 
                    $empleado->setRegistro(new \DateTime("now"));
                    $empleado->setActualizacion(new \DateTime("now"));
                            
                    //Fecha Registro y ultima actualizacion
                    $empleado->setEmision(null);
                    $empleado->setVencimiento(null);        
                    
                  

                    //Generamos Codigo de Barras (Repositorio Asociados)
                    $codigo = $empleado_repo->GenerarCodigo($form);
                    $empleado->setCodigo($codigo);
                    
                    //Guardamos codigo de barra carnetizacion anterior
                    $empleado->setOld($form->get("old")->getData());
                    
                    //Estado de ingreso
                    $empleado->setEstado($form->get("estado")->getData());
                    
                    //Imagen Perfil
                    $file = $form["imagen"]->getData();
                    if (!empty($file) && $file != null) {
                        $file = $form["imagen"]->getData();
                        $ext = $file->guessExtension();
                        $file_name = $form->get("cedula")->getData() . time() . "." . $ext;
                        $file->move("uploads/empleado", $file_name);
                        $empleado->setImagen($file_name);
                    } else {
                        $empleado->setImagen(null);
                    }

                    //Guardamos Departamento
                    $empleado->setIddepartamento($form->get("iddepartamento")->getData());
                    
                    //Guardamos Cargo
                    $empleado->setIdcargo($form->get("idcargo")->getData());

                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($empleado);
                    $flush = $em->flush();

                    if ($flush == null) {

                        $status = "Empleado creado correctamente";
                    } else {
                        $status = "Empleado no se registro correctamente";
                    }
                } else {
                    $status = "El empleado ya existe";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("empleados");
        }


        return $this->render("ModeloBundle:Empleado:add.html.twig", array(
                    "form" => $form->createView()
        ));
    }

    public function deleteEmpleadoAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $empleado_repo = $em->getRepository("ModeloBundle:Empleado");
        $empleado = $empleado_repo->find($id);
        $em->remove($empleado);
        $flush = $em->flush();
        if ($flush == null) {
            $status = "Empleado Eliminado";
        } else {
            $status = "Empleado no ha sido Eliminado";
        }          
        $this->session->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("empleados");
    }

    public function updateEmpleadoAction(Request $request, $id) {
        $em = $this->getDoctrine()->getEntityManager();
        $empleado_repo = $em->getRepository("ModeloBundle:Empleado");
        $empleado = $empleado_repo->find($id);

        $per_imagen = $empleado->getImagen();

        $form = $this->createForm(EmpleadoType::class, $empleado);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                //Datos del Socio
                $empleado->setNombres($form->get("nombres")->getData());
                $empleado->setApellidos($form->get("apellidos")->getData());
                $empleado->setCedula($form->get("cedula")->getData());
                $empleado->setNacimiento($form->get("nacimiento")->getData());
                
                //Calculamos la edad
                $edad = $empleado_repo->CalcularEdad($form->get("nacimiento")->getData(), new \DateTime("now"));
                $empleado->setEdad($edad);
                
                //Fecha Registro y ultima actualizacion 
                $empleado->setActualizacion(new \DateTime("now"));
                
                //Codigo de barra carnetizacion anterior
                $empleado->setOld($form->get("old")->getData());
                
                    
                //Estado de ingreso
                $empleado->setEstado($form->get("estado")->getData());

                //Imagen Perfil
                $file = $form["imagen"]->getData();
                if (!empty($file) && $file != null) {
                    $file = $form["imagen"]->getData();
                    $ext = $file->guessExtension();
                    $file_name = $form->get("cedula")->getData() . time() . "." . $ext;
                    $file->move("uploads/empleado", $file_name);
                    $empleado->setImagen($file_name);
                } else {
                    $empleado->setImagen($per_imagen);
                }

                //Guardamos Departamento
                $empleado->setIddepartamento($form->get("iddepartamento")->getData());

                //Guardamos Cargo
                $empleado->setIdcargo($form->get("idcargo")->getData());


                $em->persist($empleado);
                $flush = $em->flush();

                if ($flush == null) {
                    $status = "Empleado Actulizado Correctamente";
                } else {
                    $status = "Empleado no fue actualizado";
                }
            } else {
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("empleados");
        }
        return $this->render("ModeloBundle:Empleado:update.html.twig", array(
                    "form" => $form->createView()
        ));

    }

    public function detailEmpleadoAction($id) {
        $empleado = new EmpleadoController();
        $em = $this->getDoctrine()->getEntityManager();
        $empleado_repo = $em->getRepository("ModeloBundle:Empleado");
        $empleado = $empleado_repo->find($id);
        return $this->render("ModeloBundle:Empleado:detail.html.twig", array(
                    "empleado" => $empleado
        ));
    }
    
    
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        
        $search = $request->query->get("search", null);
        
        if( $search == NULL){
            $this->redirect($this->generateUrl("empleados"));            
        }
        
        $dql = "SELECT u FROM ModeloBundle:Empleado u "
                . "WHERE u.nombres LIKE :search "
                . "OR u.apellidos LIKE :search "
                . "OR u.cedula LIKE :search "
                . "OR u.codigo LIKE :search "
                . "OR u.old LIKE :search "
                . "ORDER BY u.nombres ASC";
        
        $query = $em->createQuery($dql)->setParameter('search', "%$search%");

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page', 1), 10
        );
        
        return $this->render("ModeloBundle:Empleado:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }

}
