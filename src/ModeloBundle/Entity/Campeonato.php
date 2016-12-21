<?php

namespace ModeloBundle\Entity;

/**
 * Campeonato
 */
class Campeonato
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
     * @var \ModeloBundle\Entity\Disciplina
     */
    private $iddisciplina;


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
     * @return Campeonato
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
     * @return Campeonato
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
     * Set iddisciplina
     *
     * @param \ModeloBundle\Entity\Disciplina $iddisciplina
     *
     * @return Campeonato
     */
    public function setIddisciplina(\ModeloBundle\Entity\Disciplina $iddisciplina = null)
    {
        $this->iddisciplina = $iddisciplina;

        return $this;
    }

    /**
     * Get iddisciplina
     *
     * @return \ModeloBundle\Entity\Disciplina
     */
    public function getIddisciplina()
    {
        return $this->iddisciplina;
    }
}

