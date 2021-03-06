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
     * @var integer
     */
    private $edad;

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
    private $registro;

    /**
     * @var \DateTime
     */
    private $nacimiento;

    /**
     * @var \DateTime
     */
    private $emision;

    /**
     * @var \DateTime
     */
    private $vencimiento;

    /**
     * @var \DateTime
     */
    private $actualizado;

    /**
     * @var string
     */
    private $accion;

    /**
     * @var boolean
     */
    private $solvente;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var string
     */
    private $old;

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
     * Set edad
     *
     * @param integer $edad
     *
     * @return Socio
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
     * Set registro
     *
     * @param \DateTime $registro
     *
     * @return Socio
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
     * Set nacimiento
     *
     * @param \DateTime $nacimiento
     *
     * @return Socio
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
     * Set emision
     *
     * @param \DateTime $emision
     *
     * @return Socio
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
     * @return Socio
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
     * Set actualizado
     *
     * @param \DateTime $actualizado
     *
     * @return Socio
     */
    public function setActualizado($actualizado)
    {
        $this->actualizado = $actualizado;

        return $this;
    }

    /**
     * Get actualizado
     *
     * @return \DateTime
     */
    public function getActualizado()
    {
        return $this->actualizado;
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
     * Set solvente
     *
     * @param boolean $solvente
     *
     * @return Socio
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
     * @return Socio
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
     * @return Socio
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
     * Set old
     *
     * @param string $old
     *
     * @return Socio
     */
    public function setOld($old)
    {
        $this->old = $old;

        return $this;
    }

    /**
     * Get old
     *
     * @return string
     */
    public function getOld()
    {
        return $this->old;
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
