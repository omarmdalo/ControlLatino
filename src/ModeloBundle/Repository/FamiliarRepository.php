<?php

namespace ModeloBundle\Repository;
use ModeloBundle\Entity\Asociado;
use ModeloBundle\Entity\Socio;
use ModeloBundle\Entity\Familiar;



class FamiliarRepository  extends \Doctrine\ORM\EntityRepository {
    
    
    public function GenerarCodigo($id, $relacion, $tipo){
        
        $em = $this->getEntityManager();
        $codigo="";
        if($relacion == 1){
            $socio_repo = $em->getRepository("ModeloBundle:Socio");
            $socio = $socio_repo->findOneBy(array("id"=>$id));
            $codigo="SF";
            $codigo.= $socio->getAccion();
            if( $tipo->getId() == 1){
                $codigo.="3";
                $familiar_repo = $em->getRepository("ModeloBundle:Familiar");
                $hijos = $familiar_repo->findBy(array("idsocio"=>$socio->getId(), "idtipofamiliar"=>$tipo->getId()));
                if(count($hijos) == 0){
                    $codigo.="1";
                }else{
                    $cod_hijo=0;
                    foreach ($hijos as $hijo){
                        $temp = $hijo->getCodigo();
                        $temp = (int) $temp[7];
                        if( $temp >= $cod_hijo ){
                            $cod_hijo = $temp;
                        }                           
                    }
                    $codigo.= $cod_hijo+1;                       
                }               
            }elseif($tipo->getId() == 2){
                $codigo.="20";
            }elseif($tipo->getId() == 3){
                $codigo.="40";
            }elseif($tipo->getId() == 4){
                $codigo.="50";
            }
            $codigo.="000";
        }elseif($relacion == 2){
            $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
            $asociado = $asociado_repo ->findOneBy(array("id"=>$id));
            $codigo="AF";
            $accion = $asociado->getIdsocio();         
            $codigo.= $accion->getAccion();
            $codigo.= "M";
            $aso_cod = $asociado->getCodigo();
            $codigo.= $aso_cod[7];
            if( $tipo->getId() == 1){
                $codigo.="3";
                $familiar_repo = $em->getRepository("ModeloBundle:Familiar");
                $hijos = $familiar_repo->findBy(array("idasociado"=>$asociado->getId(), "idtipofamiliar"=>$tipo->getId()));
                if(count($hijos) == 0){
                    $codigo.="1";                                         
                }else{
                    $cod_hijo=0;
                    foreach ($hijos as $hijo){
                        $temp = $hijo->getCodigo();
                        $temp = (int) $temp[9];
                        if( $temp >= $cod_hijo ){
                            $cod_hijo = $temp;
                        }                           
                    }                   
                    $codigo.= $cod_hijo+1;
                }               
            }elseif($tipo->getId() == 2){
                $codigo.="20";
            } 
            
        }
        return $codigo;
    }
    
   public function CalcularEdad($fechaN, $fechaA){

        //Fecha Actual
        $fechaActual = explode("-",$fechaA->format("Y-m-d"));
        $dia=$fechaActual[2];
        $mes=$fechaActual[1];
        $ano=$fechaActual[0];

        //Fecha de nacimiento
        $fechaNacimiento = explode("-",$fechaN->format("Y-m-d"));
        $dianaz=$fechaNacimiento[2];
        $mesnaz=$fechaNacimiento[1];
        $anonaz=$fechaNacimiento[0];
        
        if (($mesnaz == $mes) && ($dianaz > $dia)) {
        $ano=($ano-1); }

        //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

        if ($mesnaz > $mes) {
        $ano=($ano-1);}

        //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

        $edad=($ano-$anonaz);

        return $edad;
    }
      
}