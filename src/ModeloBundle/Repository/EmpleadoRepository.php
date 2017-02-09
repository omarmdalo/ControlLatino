<?php

namespace ModeloBundle\Repository;

use ModeloBundle\Entity\Empleado;
use Doctrine\ORM\Tools\Pagination\Paginator;

class EmpleadoRepository extends \Doctrine\ORM\EntityRepository {

    public function GenerarCodigo($empleado = null) {

        
        $codigo = "";
        $nombre = "";
        $apellido = "";
        $nombre = $empleado->get("nombres")->getData();
        $codigo .= $nombre[0];
        $apellido = $empleado->get("apellidos")->getData();
        $codigo .= $apellido[0];
        $codigo .= $empleado->get("cedula")->getData();

        return $codigo;
    }

}
