<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function holaAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $socio_repo = $em->getRepository("ModeloBundle:Socio");
        $socios = $socio_repo->findAll();
        
        foreach ($socios as $socio ){
            echo $socio->getNombres()."<br/>";
            echo $socio->getApellidos()."<br/>";
            echo $socio->getCedula()."<br/>";
//            echo $usuario->getIdtiposocio()->getNombre()."<br/>";
//            echo $usuario->getIdtiposocio()->getDescripcion()."<br/>";
//            echo "<hr/>";

            $asociados = $socio->getAsociado();
            foreach ($asociados as $asociado){
                echo $asociado->getNombres()." ".$asociado->getApellidos()."<br/>";
            }
            echo "<hr/>";
        }
        die();
        
        return $this->render('ModeloBundle:Default:index.html.twig');
    }
    
        public function indexAction()
    {

        
        return $this->render('ModeloBundle:Default:index.html.twig');
    }
    
    
}
