<?php

namespace ModeloBundle\Entity;

/**
 * Equipo
 */
class Equipo
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
     * @var \ModeloBundle\Entity\Campeonato
     */
    private $idcampeonato;


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
     * @return Equipo
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
     * @return Equipo
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
     * Set idcampeonato
     *
     * @param \ModeloBundle\Entity\Campeonato $idcampeonato
     *
     * @return Equipo
     */
    public function setIdcampeonato(\ModeloBundle\Entity\Campeonato $idcampeonato = null)
    {
        $this->idcampeonato = $idcampeonato;

        return $this;
    }

    /**
     * Get idcampeonato
     *
     * @return \ModeloBundle\Entity\Campeonato
     */
    public function getIdcampeonato()
    {
        return $this->idcampeonato;
    }
}

