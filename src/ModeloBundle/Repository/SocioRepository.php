<?php

namespace ModeloBundle\Repository;

use ModeloBundle\Entity\Socio;
use Doctrine\ORM\Tools\Pagination\Paginator;

class SocioRepository  extends \Doctrine\ORM\EntityRepository {
    
    public function GenerarCodigo($socio=null){

        $codigo="";
        $codigo="S";
        $codigo.=$socio;
        $codigo.="1";             
        $codigo.="0000";       
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
    
    public function MesActual($fechaA){

        //Fecha Actual
        $fechaActual = explode("-",$fechaA->format("Y-m-d"));
        $mes=$fechaActual[1];
        $ano=$fechaActual[0];        
        $fechaI= $ano=$fechaActual[0]."-".$mes=$fechaActual[1]."-01";
        return $fechaI;
    }
    
}
