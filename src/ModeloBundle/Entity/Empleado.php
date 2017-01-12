<?php

namespace ModeloBundle\Entity;

/**
 * Empleado
 */
class Empleado
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
     * @var boolean
     */
    private $estado;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var \ModeloBundle\Entity\Departamento
     */
    private $iddepartamento;

    /**
     * @var \ModeloBundle\Entity\Cargo
     */
    private $idcargo;


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
     * @return Empleado
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
     * @return Empleado
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
     * @return Empleado
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
     * @return Empleado
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
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Empleado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Empleado
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
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Empleado
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
     * Set iddepartamento
     *
     * @param \ModeloBundle\Entity\Departamento $iddepartamento
     *
     * @return Empleado
     */
    public function setIddepartamento(\ModeloBundle\Entity\Departamento $iddepartamento = null)
    {
        $this->iddepartamento = $iddepartamento;

        return $this;
    }

    /**
     * Get iddepartamento
     *
     * @return \ModeloBundle\Entity\Departamento
     */
    public function getIddepartamento()
    {
        return $this->iddepartamento;
    }

    /**
     * Set idcargo
     *
     * @param \ModeloBundle\Entity\Cargo $idcargo
     *
     * @return Empleado
     */
    public function setIdcargo(\ModeloBundle\Entity\Cargo $idcargo = null)
    {
        $this->idcargo = $idcargo;

        return $this;
    }

    /**
     * Get idcargo
     *
     * @return \ModeloBundle\Entity\Cargo
     */
    public function getIdcargo()
    {
        return $this->idcargo;
    }
}

