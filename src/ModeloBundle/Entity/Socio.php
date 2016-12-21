<?php

namespace ModeloBundle\Entity;

/**
 * Socio
 */
class Socio
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
     * @var string
     */
    private $razonSocial;

    /**
     * @var string
     */
    private $rif;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $accion;

    /**
     * @var \ModeloBundle\Entity\Tiposocio
     */
    private $idtiposocio;


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
     * @return Socio
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
     * @return Socio
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
     * @return Socio
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
     * Set razonSocial
     *
     * @param string $razonSocial
     *
     * @return Socio
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    /**
     * Get razonSocial
     *
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Set rif
     *
     * @param string $rif
     *
     * @return Socio
     */
    public function setRif($rif)
    {
        $this->rif = $rif;

        return $this;
    }

    /**
     * Get rif
     *
     * @return string
     */
    public function getRif()
    {
        return $this->rif;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Socio
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
     * Set accion
     *
     * @param string $accion
     *
     * @return Socio
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Get accion
     *
     * @return string
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set idtiposocio
     *
     * @param \ModeloBundle\Entity\Tiposocio $idtiposocio
     *
     * @return Socio
     */
    public function setIdtiposocio(\ModeloBundle\Entity\Tiposocio $idtiposocio = null)
    {
        $this->idtiposocio = $idtiposocio;

        return $this;
    }

    /**
     * Get idtiposocio
     *
     * @return \ModeloBundle\Entity\Tiposocio
     */
    public function getIdtiposocio()
    {
        return $this->idtiposocio;
    }
}

