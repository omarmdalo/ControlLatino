<?php

namespace ModeloBundle\Repository;

use ModeloBundle\Entity\Socio;
use ModeloBundle\Entity\Asociado;

class AsociadoRepository  extends \Doctrine\ORM\EntityRepository {
    
    public function GenerarCodigo($socio=null){

        $em = $this->getEntityManager();
        
        $codigo="";
        $codigo.=$socio->getAccion();
        $codigo.="M";
             
        $afiliados_repo = $em->getRepository("ModeloBundle:Asociado");
        $temp = $afiliados_repo ->findBy(array("idsocio"=>$socio->getId()));
               
        
        if(isset($temp)){
            $afiliados = count($temp);
            $codigo.=$afiliados+1;                       
        }else{
            $codigo.="1";
        }
        $codigo.="1";
        $codigo.="0";
        
        return $codigo;
    }
      
}