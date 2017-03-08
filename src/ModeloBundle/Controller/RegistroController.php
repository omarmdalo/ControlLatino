<?php

namespace ModeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Asociado;
use ModeloBundle\Entity\Socio;
use ModeloBundle\Entity\Familiar;
use ModeloBundle\Entity\Jugador;
use ModeloBundle\Form\RegistroType;
use ModeloBundle\Entity\Registro;
use Symfony\Component\HttpFoundation\Session\Session;


class RegistroController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }
   
    public function registerAction(Request $request) {
        
        $registro = new Registro();
        $form = $this->createForm(RegistroType::class, $registro);
        $form->handleRequest($request);
        $codigo ="";
        $edad = 0;
        $tipo = "";
        if ($form->isSubmitted()) {
            if ($form->isValid()) {              
                $codigo = $form->get("codigo")->getData();                
                if($codigo[0] == "S"){
                    $tipo = 1;
                    $socio = new Socio();
                    $em = $this->getDoctrine()->getEntityManager();                    
                    $socio_repo = $em->getRepository("ModeloBundle:Socio");
                    $socio = $socio_repo->findOneBy(array("codigo" => $codigo));
                    if (count($socio) != 0) {
                        //Actualizar la edad
                        $edad=$socio_repo->CalcularEdad($socio->getNacimiento(), new \DateTime("now"));
                        $socio->setEdad($edad);
                        $em->persist($socio);
                        $em->flush();
                        
                        $fechaini=$socio_repo->MesActual(new \DateTime("now"));
                        var_dump($edad);
                        var_dump($fechaini);
                        die();
                        
                        $db = $em->getConnection();
                        $query = "SELECT P.fecha AS fechaju, E.nombre AS nombre_eq, C.nombre AS nombre_ca   
                                    FROM partido P 
                                    INNER JOIN partido_jugador W ON P.id = W.idPartido
                                    INNER JOIN equipo E ON W.idEquipo = E.id
                                    INNER JOIN campeonato C ON P.idcampeonato = C.id
                                    INNER JOIN jugador_equipo R ON W.idEquipo = R.idEquipo
                                    INNER JOIN socio S ON R.idSocio = S.id
                                    WHERE P.fecha < NOW() AND S.id = :id 
                                    ";
                        $stmt = $db->prepare($query);                        
                        $params = array("id"=>$socio->getId());
                        $stmt->execute($params);        
                        $juegos = $stmt->fetchAll();
                        
                        
                        
                        if($socio->getSolvente() == true){
                            if($socio->getVencimiento() > new \DateTime("now") ){                                
                                $status = "Entrada Autorizada";
                                $entrada = true;
                                $this->session->getFlashBag()->add("status", $status);
                                return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                        "data" => $socio,
                                        "juegos" => $juegos,
                                        "entrada" => $entrada,
                                        "invitados" => $invitados,
                                        "tipo" => $tipo
                                ));
                                
                            }
                            else{
                                $status = "Entrada Negada, Carnet Vencido, Dirigirse a administracion";
                                $entrada = false;
                                $this->session->getFlashBag()->add("status", $status);
                                return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                        "data" => $socio,
                                        "juegos" => $juegos,
                                        "entrada" => $entrada,
                                        "invitados" => $invitados,
                                        "tipo" => $tipo
                            ));
                                
                            }
                        }
                        else{
                            $status = "Entrada Negada, Dirigirse a administracion";
                            $entrada = false;
                            $this->session->getFlashBag()->add("status", $status);
                            return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                        "data" => $socio,
                                        "juegos" => $juegos,
                                        "entrada" => $entrada,
                                        "invitados" => $invitados,
                                        "tipo" => $tipo
                            ));
                        }
                       
                    }
                    else{
                        $status = "Carnet no se encuentra registrado";
                        $this->session->getFlashBag()->add("status", $status);
                        return $this->redirectToRoute("registro");                       
                    }
                }
                elseif($codigo[0] == "A"){
                    $tipo = 2;
                    $asociado = new Asociado();
                    $em = $this->getDoctrine()->getEntityManager();                    
                    $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
                    $asociado = $asociado_repo->findOneBy(array("codigo" => $codigo));
                    if (count($asociado) != 0) {
                        //Actualizar la edad
                        $edad=$asociado_repo->CalcularEdad($asociado->getNacimiento(), new \DateTime("now"));
                        $asociado->setEdad($edad);
                        $em->persist($asociado);
                        $em->flush();
                        
                        $db = $em->getConnection();
                        $query = "SELECT P.fecha AS fechaju, E.nombre AS nombre_eq, C.nombre AS nombre_ca   
                                    FROM partido P 
                                    INNER JOIN partido_jugador W ON P.id = W.idPartido
                                    INNER JOIN equipo E ON W.idEquipo = E.id
                                    INNER JOIN campeonato C ON P.idcampeonato = C.id
                                    INNER JOIN jugador_equipo R ON W.idEquipo = R.idEquipo
                                    INNER JOIN asociado A ON R.idAsociado = A.id
                                    WHERE P.fecha < NOW() AND A.id = :id 
                                    ";
                        $stmt = $db->prepare($query);                        
                        $params = array("id"=>$asociado->getId());
                        $stmt->execute($params);        
                        $juegos = $stmt->fetchAll();
                                             
                        if($asociado->getSolvente() == true){
                            if($asociado->getVencimiento() > new \DateTime("now") ){                                
                                $status = "Entrada Autorizada";
                                $entrada = true;
                                $this->session->getFlashBag()->add("status", $status);
                                return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                        "data" => $asociado,
                                        "juegos" => $juegos,
                                        "entrada" => $entrada,
                                        "tipo" => $tipo
                                ));
                                
                            }
                            else{
                                $status = "Entrada Negada, Carnet Vencido, Dirigirse a administracion";
                                $entrada = false;
                                $this->session->getFlashBag()->add("status", $status);
                                return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                        "data" => $asociado,
                                        "juegos" => $juegos,
                                        "entrada" => $entrada,
                                        "tipo" => $tipo
                            ));
                                
                            }
                        }
                        else{
                            var_dump("Insolvente");
                            die();
                            $status = "Entrada Negada, Dirigirse a administracion";
                            $entrada = false;
                            $this->session->getFlashBag()->add("status", $status);
                            return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                        "data" => $asociado,
                                        "juegos" => $juegos,
                                        "entrada" => $entrada,
                                        "tipo" => $tipo
                            ));
                        }
                       
                    }
                    else{
                        $status = "Carnet no se encuentra registrado";
                        $this->session->getFlashBag()->add("status", $status);
                        return $this->redirectToRoute("registro");                       
                    }
                }
                elseif($codigo[0] == "F"){
                    $tipo = 3;
                    $juegos = "";
                    $familiar = new Familiar();
                    $em = $this->getDoctrine()->getEntityManager();                    
                    $familiar_repo = $em->getRepository("ModeloBundle:Familiar");
                    $familiar = $familiar_repo->findOneBy(array("codigo" => $codigo));
                    if (count($familiar) != 0) {

                        //Actualizar la edad
                        $edad=$familiar_repo->CalcularEdad($familiar->getNacimiento(), new \DateTime("now"));
                        $familiar->setEdad($edad);
                        $em->persist($familiar);
                        $em->flush();
                        /*
                        $db = $em->getConnection();
                        $query = "SELECT P.fecha AS fechaju, E.nombre AS nombre_eq, C.nombre AS nombre_ca   
                                    FROM partido P 
                                    INNER JOIN partido_jugador W ON P.id = W.idPartido
                                    INNER JOIN equipo E ON W.idEquipo = E.id
                                    INNER JOIN campeonato C ON P.idcampeonato = C.id
                                    INNER JOIN jugador_equipo R ON W.idEquipo = R.idEquipo
                                    INNER JOIN familiar J ON R.idFamiliar = J.id
                                    WHERE P.fecha < NOW() AND J.id = :id 
                                    ";
                        $stmt = $db->prepare($query);                        
                        $params = array("id"=>$familiar->getId());
                        $stmt->execute($params);        
                        $juegos = $stmt->fetchAll();
                        */                     
                        if($familiar->getSolvente() == true){
                            if($familiar->getVencimiento() > new \DateTime("now") ){
                                if($codigo[5] == "3" || $codigo[7] == "3" ){
                                    if($familiar->getEdad() < 25 ){
                                        $status = "Entrada Autorizada";
                                        $entrada = true;
                                        $this->session->getFlashBag()->add("status", $status);
                                        return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                                "data" => $familiar,
                                                "juegos" => $juegos,
                                                "entrada" => $entrada,
                                                "tipo" => $tipo
                                        ));
                                    }else{
                                        $status = "Entrada Negada, Hijo de Socio Mayor de 25 años, Dirigirse a administracion";
                                        $entrada = false;
                                        $this->session->getFlashBag()->add("status", $status);
                                        return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                                "data" => $familiar,
                                                "juegos" => $juegos,
                                                "entrada" => $entrada,
                                                "tipo" => $tipo
                                        ));
                                    }
                                }
                                else{
                                    $status = "Entrada Autorizada";
                                    $entrada = true;
                                    $this->session->getFlashBag()->add("status", $status);
                                    return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                            "data" => $familiar,
                                            "juegos" => $juegos,
                                            "entrada" => $entrada,
                                            "tipo" => $tipo
                                    ));
                                }   
                            }
                            else{
                                $status = "Entrada Negada, Carnet Vencido, Dirigirse a administracion";
                                $entrada = false;
                                $this->session->getFlashBag()->add("status", $status);
                                return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                        "data" => $familiar,
                                        "juegos" => $juegos,
                                        "entrada" => $entrada,
                                        "tipo" => $tipo
                                ));
                                
                            }
                        }
                        else{
                            $status = "Entrada Negada, Dirigirse a administracion";
                            $entrada = false;
                            $this->session->getFlashBag()->add("status", $status);
                            return $this->render("ModeloBundle:Registro:detail.html.twig", array(
                                        "data" => $familiar,
                                        "juegos" => $juegos,
                                        "entrada" => $entrada,
                                        "tipo" => $tipo
                            ));
                        }
                       
                    }
                    else{
                        $status = "Carnet no se encuentra registrado";
                        $this->session->getFlashBag()->add("status", $status);
                        return $this->redirectToRoute("registro");                       
                    }
                }
               
            }
        }
            
        return $this->render("ModeloBundle:Registro:register.html.twig", array(
                    "form" => $form->createView()
        ));

    }
    
}
