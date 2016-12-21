<?php

namespace ModeloBundle\Entity;

/**
 * PartidoJugador
 */
class PartidoJugador
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \ModeloBundle\Entity\Equipo
     */
    private $idequipo;

    /**
     * @var \ModeloBundle\Entity\Partido
     */
    private $idpartido;


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
     * Set idequipo
     *
     * @param \ModeloBundle\Entity\Equipo $idequipo
     *
     * @return PartidoJugador
     */
    public function setIdequipo(\ModeloBundle\Entity\Equipo $idequipo = null)
    {
        $this->idequipo = $idequipo;

        return $this;
    }

    /**
     * Get idequipo
     *
     * @return \ModeloBundle\Entity\Equipo
     */
    public function getIdequipo()
    {
        return $this->idequipo;
    }

    /**
     * Set idpartido
     *
     * @param \ModeloBundle\Entity\Partido $idpartido
     *
     * @return PartidoJugador
     */
    public function setIdpartido(\ModeloBundle\Entity\Partido $idpartido = null)
    {
        $this->idpartido = $idpartido;

        return $this;
    }

    /**
     * Get idpartido
     *
     * @return \ModeloBundle\Entity\Partido
     */
    public function getIdpartido()
    {
        return $this->idpartido;
    }
}

