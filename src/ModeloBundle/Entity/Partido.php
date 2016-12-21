<?php

namespace ModeloBundle\Entity;

/**
 * Partido
 */
class Partido
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fecha;

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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Partido
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
     * Set idcampeonato
     *
     * @param \ModeloBundle\Entity\Campeonato $idcampeonato
     *
     * @return Partido
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

