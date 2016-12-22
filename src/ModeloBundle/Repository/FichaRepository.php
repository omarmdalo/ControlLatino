<?php

namespace ModeloBundle\Repository;

use ModeloBundle\Entity\Invitado;
use ModeloBundle\Entity\InvitadoFicha;
use Doctrine\ORM\Tools\Pagination\Paginator;

class FichaRepository  extends \Doctrine\ORM\EntityRepository {
    
    public function saveFichaInvitados($invitados=null, $motivo=null, $socio=null, $user=null, $ficha=null){
        $em = $this->getEntityManager();
        //var_dump($socio);
        //var_dump($user);
        //die();
            
            if($ficha==null){
                $ficha = $this->findOneBy(array(
                   "motivo"=>$motivo,
                   "idsocio"=>$socio,
                   "idusuario"=>$user       
                ));
            }
        //var_dump($invitados);
        $invitados = explode("/",$invitados);
        $invitados_repo = $em->getRepository("ModeloBundle:Invitado");
        //var_dump($invitados); 
        foreach ($invitados as $invitado){
            //var_dump($invitado);
            $invitado = explode(" ",$invitado);            
            $temp = $invitados_repo->findOneBy(array("ceula"=>$invitado[2]));
            //($invitado);
            //die();
            if(count ($temp) == 0){
                $invitado_obj = new Invitado();
                $invitado_obj->setNombres($invitado[0]);
                $invitado_obj->setApellidos($invitado[1]);
                $invitado_obj->setCeula($invitado[2]);
                $em->persist($invitado_obj);
                $em->flush();
            }
            
            $invitado = $invitados_repo->findOneBy(array("ceula"=>$invitado[2]));
            $invitadoficha = new InvitadoFicha();
            $invitadoficha->setIdficha($ficha);
            $invitadoficha->setIdinvitado($invitado);
            $em->persist($invitadoficha);
            
        }
        
        $flush = $em->flush();
        return $flush;
    }
    
    public function getPaginateEntries($pageSize=5, $currentPage=1){
        $em = $this->getEntityManager();
        
        $dql = "SELECT e FROM ModeloBundle\Entity\Ficha e ORDER BY e.id DESC";
        $query= $em->createQuery($dql)
                    ->setFirstResult($pageSize*($currentPage-1))
                    ->setMaxResults($pageSize);
        
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        
        return $paginator;
    }
    
}
