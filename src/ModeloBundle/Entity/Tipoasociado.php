<?php

namespace ModeloBundle\Entity;

/**
 * Tipoasociado
 */
class Tipoasociado
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $contribuyente;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Tipoasociado
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tipoasociado
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set contribuyente
     *
     * @param string $contribuyente
     *
     * @return Tipoasociado
     */
    public function setContribuyente($contribuyente)
    {
        $this->contribuyente = $contribuyente;

        return $this;
    }

    /**
     * Get contribuyente
     *
     * @return string
     */
    public function getContribuyente()
    {
        return $this->contribuyente;
    }
}

