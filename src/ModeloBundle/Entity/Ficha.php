<?php

namespace ModeloBundle\Entity;

/**
 * Ficha
 */
class Ficha
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $motivo;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var \ModeloBundle\Entity\Usuario
     */
    private $idusuario;

    /**
     * @var \ModeloBundle\Entity\Socio
     */
    private $idsocio;


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
     * Set motivo
     *
     * @param string $motivo
     *
     * @return Ficha
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;

        return $this;
    }

    /**
     * Get motivo
     *
     * @return string
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Ficha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set idusuario
     *
     * @param \ModeloBundle\Entity\Usuario $idusuario
     *
     * @return Ficha
     */
    public function setIdusuario(\ModeloBundle\Entity\Usuario $idusuario = null)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get idusuario
     *
     * @return \ModeloBundle\Entity\Usuario
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set idsocio
     *
     * @param \ModeloBundle\Entity\Socio $idsocio
     *
     * @return Ficha
     */
    public function setIdsocio(\ModeloBundle\Entity\Socio $idsocio = null)
    {
        $this->idsocio = $idsocio;

        return $this;
    }

    /**
     * Get idsocio
     *
     * @return \ModeloBundle\Entity\Socio
     */
    public function getIdsocio()
    {
        return $this->idsocio;
    }
}

