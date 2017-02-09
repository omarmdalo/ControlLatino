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
     * @var integer
     */
    private $edad;

    /**
     * @var \DateTime
     */
    private $nacimiento;

    /**
     * @var \DateTime
     */
    private $registro;

    /**
     * @var \DateTime
     */
    private $actualizacion;

    /**
     * @var \DateTime
     */
    private $emision;

    /**
     * @var \DateTime
     */
    private $vencimiento;

    /**
     * @var string
     */
    private $numasociado;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var boolean
     */
    private $solvente;

    /**
     * @var string
     */
    private $imagen;

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
     * Set edad
     *
     * @param integer $edad
     *
     * @return Asociado
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set nacimiento
     *
     * @param \DateTime $nacimiento
     *
     * @return Asociado
     */
    public function setNacimiento($nacimiento)
    {
        $this->nacimiento = $nacimiento;

        return $this;
    }

    /**
     * Get nacimiento
     *
     * @return \DateTime
     */
    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    /**
     * Set registro
     *
     * @param \DateTime $registro
     *
     * @return Asociado
     */
    public function setRegistro($registro)
    {
        $this->registro = $registro;

        return $this;
    }

    /**
     * Get registro
     *
     * @return \DateTime
     */
    public function getRegistro()
    {
        return $this->registro;
    }

    /**
     * Set actualizacion
     *
     * @param \DateTime $actualizacion
     *
     * @return Asociado
     */
    public function setActualizacion($actualizacion)
    {
        $this->actualizacion = $actualizacion;

        return $this;
    }

    /**
     * Get actualizacion
     *
     * @return \DateTime
     */
    public function getActualizacion()
    {
        return $this->actualizacion;
    }

    /**
     * Set emision
     *
     * @param \DateTime $emision
     *
     * @return Asociado
     */
    public function setEmision($emision)
    {
        $this->emision = $emision;

        return $this;
    }

    /**
     * Get emision
     *
     * @return \DateTime
     */
    public function getEmision()
    {
        return $this->emision;
    }

    /**
     * Set vencimiento
     *
     * @param \DateTime $vencimiento
     *
     * @return Asociado
     */
    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;

        return $this;
    }

    /**
     * Get vencimiento
     *
     * @return \DateTime
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    /**
     * Set numasociado
     *
     * @param string $numasociado
     *
     * @return Asociado
     */
    public function setNumasociado($numasociado)
    {
        $this->numasociado = $numasociado;

        return $this;
    }

    /**
     * Get numasociado
     *
     * @return string
     */
    public function getNumasociado()
    {
        return $this->numasociado;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Asociado
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
     * Set solvente
     *
     * @param boolean $solvente
     *
     * @return Asociado
     */
    public function setSolvente($solvente)
    {
        $this->solvente = $solvente;

        return $this;
    }

    /**
     * Get solvente
     *
     * @return boolean
     */
    public function getSolvente()
    {
        return $this->solvente;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Asociado
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
}
