<?php

namespace ModeloBundle\Entity;

/**
 * Familiar
 */
class Familiar
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
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var \ModeloBundle\Entity\Socio
     */
    private $idsocio;

    /**
     * @var \ModeloBundle\Entity\Asociado
     */
    private $idasociado;

    /**
     * @var \ModeloBundle\Entity\Tipofamiliar
     */
    private $idtipofamiliar;


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
     * @return Familiar
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
     * @return Familiar
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
     * @return Familiar
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
     * @return Familiar
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
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Familiar
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Familiar
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set idsocio
     *
     * @param \ModeloBundle\Entity\Socio $idsocio
     *
     * @return Familiar
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
     * Set idasociado
     *
     * @param \ModeloBundle\Entity\Asociado $idasociado
     *
     * @return Familiar
     */
    public function setIdasociado(\ModeloBundle\Entity\Asociado $idasociado = null)
    {
        $this->idasociado = $idasociado;

        return $this;
    }

    /**
     * Get idasociado
     *
     * @return \ModeloBundle\Entity\Asociado
     */
    public function getIdasociado()
    {
        return $this->idasociado;
    }

    /**
     * Set idtipofamiliar
     *
     * @param \ModeloBundle\Entity\Tipofamiliar $idtipofamiliar
     *
     * @return Familiar
     */
    public function setIdtipofamiliar(\ModeloBundle\Entity\Tipofamiliar $idtipofamiliar = null)
    {
        $this->idtipofamiliar = $idtipofamiliar;

        return $this;
    }

    /**
     * Get idtipofamiliar
     *
     * @return \ModeloBundle\Entity\Tipofamiliar
     */
    public function getIdtipofamiliar()
    {
        return $this->idtipofamiliar;
    }
}

