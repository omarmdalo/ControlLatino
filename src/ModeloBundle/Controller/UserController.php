<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Usuario;
use ModeloBundle\Form\UsuarioType;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }

    public function loginAction(Request $request){
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername=$authenticationUtils->getLastUsername();
        
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
                    $user->setRole("ROLE_USER");
                    $user->setIdempleado(null);
                    $user->setCaducidad(null);
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
        }
        
        
        return $this->render("ModeloBundle:User:login.html.twig", array(
            "error" => $error,
            "last_username" => $lastUsername,
            "form" => $form->createView()
        ));
        
    }
}
