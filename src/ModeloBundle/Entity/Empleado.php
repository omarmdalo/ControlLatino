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

