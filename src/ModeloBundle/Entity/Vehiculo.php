<?php

namespace ModeloBundle\Entity;

/**
 * Vehiculo
 */
class Vehiculo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $modelo;

    /**
     * @var string
     */
    private $marca;

    /**
     * @var string
     */
    private $placa;

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
     * Set modelo
     *
     * @param string $modelo
     *
     * @return Vehiculo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set marca
     *
     * @param string $marca
     *
     * @return Vehiculo
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set placa
     *
     * @param string $placa
     *
     * @return Vehiculo
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;

        return $this;
    }

    /**
     * Get placa
     *
     * @return string
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * Set idsocio
     *
     * @param \ModeloBundle\Entity\Socio $idsocio
     *
     * @return Vehiculo
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

