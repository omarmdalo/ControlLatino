<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ModeloBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }

    public function inicioAction(){
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername=$authenticationUtils->getLastUsername();
                                
        return $this->render("ModeloBundle::login.html.twig", array(
            "error" => $error,
            "last_username" => $lastUsername,
        ));
        
    }
}
