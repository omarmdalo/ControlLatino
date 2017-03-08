<?php

namespace ModeloBundle\Repository;

use ModeloBundle\Entity\Socio;
use ModeloBundle\Entity\Asociado;

class AsociadoRepository  extends \Doctrine\ORM\EntityRepository {
    
    public function GenerarCodigo($socio=null){

        $em = $this->getEntityManager();
        $codigo="";
        $codigo="A";
        $codigo.=$socio->getAccion();
        $codigo.="M";
        
        //Buscamos el numero de asociados
        $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
        $asociados = $asociado_repo ->findOneBy(array("idsocio"=>$socio->getId()));
               
        
        if(count($asociados) == 0){
            $codigo.="1";                                  
        }else{
            $cod_aso=0;
            foreach ($asociados as $asociado){
                $temp = $asociado->getCodigo();
                $temp = (int) $temp[6];
                if( $temp >= $cod_aso ){
                    $cod_aso = $temp;
                }                           
            }
            $codigo.=$cod_aso+1; 
        }
        $codigo.="00";       
        return $codigo;
    }
    
     public function GenerarNumAsociado($socio=null){

        $em = $this->getEntityManager();
        
        $num_aso="";
        $num_aso.=$socio->getAccion();
        $num_aso.="M";
             
        //Buscamos el numero de asociados
        $asociado_repo = $em->getRepository("ModeloBundle:Asociado");
        $asociados = $asociado_repo ->findBy(array("idsocio"=>$socio->getId()));
               
         if(count($asociados) == 0){
            $num_aso.="1";                                  
        }else{
            $n_aso=0;
            foreach ($asociados as $asociado){
                $temp = $asociado->getNumasociado();
                $temp = (int) $temp[5];
                if( $temp >= $n_aso ){
                    $n_aso = $temp;
                }                           
            }
            $num_aso.=$n_aso+1; 
        }     
        return $num_aso;
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