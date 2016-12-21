<?php

namespace ModeloBundle\Entity;

/**
 * Asociado
 */
class Asociado
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombres;

    /**
     * @var string
     */
    private $apellidos;

    /**
     * @var string
     */
    private $cedula;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var \ModeloBundle\Entity\Socio
     */
    private $idsocio;

    /**
     * @var \ModeloBundle\Entity\Tipoasociado
     */
    private $idtipoasociado;


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
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Asociado
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Asociado
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Asociado
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Asociado
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
     * Set idsocio
     *
     * @param \ModeloBundle\Entity\Socio $idsocio
     *
     * @return Asociado
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

    /**
     * Set idtipoasociado
     *
     * @param \ModeloBundle\Entity\Tipoasociado $idtipoasociado
     *
     * @return Asociado
     */
    public function setIdtipoasociado(\ModeloBundle\Entity\Tipoasociado $idtipoasociado = null)
    {
        $this->idtipoasociado = $idtipoasociado;

        return $this;
    }

    /**
     * Get idtipoasociado
     *
     * @return \ModeloBundle\Entity\Tipoasociado
     */
    public function getIdtipoasociado()
    {
        return $this->idtipoasociado;
    }
}

