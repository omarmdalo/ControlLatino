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
     * Set edad
     *
     * @param integer $edad
     *
     * @return Familiar
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
     * @return Familiar
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
     * @return Familiar
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
     * @return Familiar
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
     * @return Familiar
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
     * @return Familiar
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
     * Set old
     *
     * @param string $old
     *
     * @return Familiar
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
