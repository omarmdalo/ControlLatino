<?php

namespace ModeloBundle\Entity;

/**
 * JugadorEquipo
 */
class JugadorEquipo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \ModeloBundle\Entity\Asociado
     */
    private $idasociado;

    /**
     * @var \ModeloBundle\Entity\Socio
     */
    private $idsocio;

    /**
     * @var \ModeloBundle\Entity\Jugador
     */
    private $idjugador;

    /**
     * @var \ModeloBundle\Entity\Equipo
     */
    private $idequipo;


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
     * Set idasociado
     *
     * @param \ModeloBundle\Entity\Asociado $idasociado
     *
     * @return JugadorEquipo
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
     * Set idsocio
     *
     * @param \ModeloBundle\Entity\Socio $idsocio
     *
     * @return JugadorEquipo
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
     * Set idjugador
     *
     * @param \ModeloBundle\Entity\Jugador $idjugador
     *
     * @return JugadorEquipo
     */
    public function setIdjugador(\ModeloBundle\Entity\Jugador $idjugador = null)
    {
        $this->idjugador = $idjugador;

        return $this;
    }

    /**
     * Get idjugador
     *
     * @return \ModeloBundle\Entity\Jugador
     */
    public function getIdjugador()
    {
        return $this->idjugador;
    }

    /**
     * Set idequipo
     *
     * @param \ModeloBundle\Entity\Equipo $idequipo
     *
     * @return JugadorEquipo
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
}
