<?php

namespace ModeloBundle\Repository;

use ModeloBundle\Entity\Socio;
use ModeloBundle\Entity\Asociado;
use Doctrine\ORM\Tools\Pagination\Paginator;

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
    
    /*
    public function getPaginateAsociado($pageSize=5, $currentPage=1){
        $em = $this->getEntityManager();
        
        $dql = "SELECT e FROM ModeloBundle\Entity\Ficha e ORDER BY e.id DESC";
        $query= $em->createQuery($dql)
                    ->setFirstResult($pageSize*($currentPage-1))
                    ->setMaxResults($pageSize);
        
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        
        return $paginator;
    }    
     */
    
}
