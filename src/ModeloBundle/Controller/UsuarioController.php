<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ModeloBundle\Entity\Usuario;
use ModeloBundle\Form\UsuarioType;
use Symfony\Component\HttpFoundation\Session\Session;

class UsuarioController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }
    
    public function indexAction(Request $request){
        
    $em = $this->getDoctrine()->getEntityManager();
    $dql = "SELECT u FROM ModeloBundle:Usuario u ORDER BY u.email ASC";
    $query = $em->createQuery($dql);

    $paginator = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
            $query, $request->query->getInt('page', 1), 10
    );    
    return $this->render("ModeloBundle:Usuario:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }
    

    public function addUsuarioAction(Request $request){

        //Accion del Formulario
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class, $user);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                $em = $this->getDoctrine()->getEntityManager();
                $user_repo=$em->getRepository("ModeloBundle:Usuario");
                $user = $user_repo->findOneBy(array("email" => $form->get("email")->getData()));
                if(count($user)== 0){
                    $user = new Usuario();
                    $user->setNombre($form->get("nombre")->getData());
                    $user->setEmail($form->get("email")->getData());

                    //Codificar Password
                    $factory = $this->get("security.encoder_factory");
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get("password")->getData(), $user->getSalt());
                    $user->setPassword($password);
                    $user->setRole($form->get("role")->getData());
                    $user->setIdempleado($form->get("idempleado")->getData());
                    $user->setCaducidad(new \DateTime("now"));
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($user);
                    $flush = $em->flush();

                    if($flush == null){
                        $status = "El usuario se ha creado correctamente";
                    }else{
                        $status = "No te has registrado correctamente";
                    }
                }else{
                    $status = "El usuario ya existe";
                }        
            }else{
                $status = "Formulario Incorrecto";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("usuarios");
        }
        
        
        return $this->render("ModeloBundle:Usuario:add.html.twig", array(
            "form" => $form->createView()
        ));   
    }
    
    public function deleteUsuarioAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $usuario_repo = $em->getRepository("ModeloBundle:Usuario");
        $usuario = $usuario_repo->find($id);
        $em->remove($usuario);
        $flush = $em->flush();
        if ($flush == null) {
            $status = "Empleado Eliminado";
        } else {
            $status = "Empleado no ha sido Eliminado";
        } 
        return $this->redirectToRoute("usuarios");
    }
    
    public function updateUsuarioAction(Request $request, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $usuario_repo = $em->getRepository("ModeloBundle:Usuario");
        $user = $usuario_repo->find($id);
        
        $form = $this->createForm(UsuarioType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                
                    $user->setNombre($form->get("nombre")->getData());
                    $user->setEmail($form->get("email")->getData());

                    //Codificar Password
                    $factory = $this->get("security.encoder_factory");
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get("password")->getData(), $user->getSalt());
                    $user->setPassword($password);
                    $user->setRole($form->get("role")->getData());
                    $user->setIdempleado($form->get("idempleado")->getData());
                    $user->setCaducidad(new \DateTime("now"));
                                        
                    $em->persist($user);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Usuario Actulizado Correctamente";
                    } else {
                        $status = "Usuario no fue actualizado";
                    }
                }else {
                $status = "Formulario Incorrecto";
                }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("usuarios");
        }       
        return $this->render("ModeloBundle:Usuario:update.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
    public function detailUsuarioAction($id){
        $usuario = new Usuario();
        $em = $this->getDoctrine()->getEntityManager();
        $usuario_repo = $em->getRepository("ModeloBundle:Usuario");
        $usuario = $usuario_repo->find($id);
        return $this->render("ModeloBundle:Usuario:detail.html.twig", array(
                        "usuario" => $usuario
            ));
    }
    
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        
        $search = $request->query->get("search", null);
        
        if( $search == NULL){
            $this->redirect($this->generateUrl("usuarios"));            
        }
        
        $dql = "SELECT u FROM ModeloBundle:Usuario u "
                . "WHERE u.nombre LIKE :search "
                . "OR u.email LIKE :search "
                . "ORDER BY u.email ASC";
        
        $query = $em->createQuery($dql)->setParameter('search', "%$search%");

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page', 1), 10
        );
        
        return $this->render("ModeloBundle:Asociado:index.html.twig", array(
                    "pagination" => $pagination
        ));
    }
    
        public function emailTestAction(Request $request) {
        
            //Recibimos por POST
            $email = $request->get("email");
            
            //Comprobamos con la BD
            $em = $this->getDoctrine()->getEntityManager();
            $usuario_repo = $em->getRepository("ModeloBundle:Usuario");
            $usuario_isset = $usuario_repo->findOneBy(array("email" => $email));
            
            if(count($usuario_isset)>= 1 && is_object($usuario_isset)){
                $result = "Usado";
            }else{
                $result = "No Usado";
            }
        
            return new Response($result);
    }
}

