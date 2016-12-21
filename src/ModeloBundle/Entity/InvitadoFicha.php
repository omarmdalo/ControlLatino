<?php

namespace ModeloBundle\Entity;

/**
 * InvitadoFicha
 */
class InvitadoFicha
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \ModeloBundle\Entity\Ficha
     */
    private $idficha;

    /**
     * @var \ModeloBundle\Entity\Invitado
     */
    private $idinvitado;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idficha
     *
     * @param \ModeloBundle\Entity\Ficha $idficha
     *
     * @return InvitadoFicha
     */
    public function setIdficha(\ModeloBundle\Entity\Ficha $idficha = null)
    {
        $this->idficha = $idficha;

        return $this;
    }

    /**
     * Get idficha
     *
     * @return \ModeloBundle\Entity\Ficha
     */
    public function getIdficha()
    {
        return $this->idficha;
    }

    /**
     * Set idinvitado
     *
     * @param \ModeloBundle\Entity\Invitado $idinvitado
     *
     * @return InvitadoFicha
     */
    public function setIdinvitado(\ModeloBundle\Entity\Invitado $idinvitado = null)
    {
        $this->idinvitado = $idinvitado;

        return $this;
    }

    /**
     * Get idinvitado
     *
     * @return \ModeloBundle\Entity\Invitado
     */
    public function getIdinvitado()
    {
        return $this->idinvitado;
    }
}

