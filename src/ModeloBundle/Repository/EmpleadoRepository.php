<?php

namespace ModeloBundle\Repository;

use ModeloBundle\Entity\Empleado;
use Doctrine\ORM\Tools\Pagination\Paginator;

class EmpleadoRepository extends \Doctrine\ORM\EntityRepository {

    public function GenerarCodigo($empleado = null) {

        
        $codigo = "";
        $codigo = "E";
        $nombre = "";
        $apellido = "";
        $nombre = $empleado->get("nombres")->getData();
        $codigo .= $nombre[0];
        $apellido = $empleado->get("apellidos")->getData();
        $codigo .= $apellido[0];
        $codigo .= $empleado->get("cedula")->getData();

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
