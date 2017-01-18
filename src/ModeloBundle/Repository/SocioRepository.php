<?php

namespace ModeloBundle\Repository;

use ModeloBundle\Entity\Socio;
use Doctrine\ORM\Tools\Pagination\Paginator;

class SocioRepository  extends \Doctrine\ORM\EntityRepository {
    
    public function GenerarCodigo($socio=null){

        $em = $this->getEntityManager();
        
        $codigo="";
        $codigo.=$socio;
        $codigo.="1";             
        $codigo.="0000";       
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
