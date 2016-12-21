<?php

namespace ModeloBundle\Entity;

/**
 * Registro
 */
class Registro
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $entrada;

    /**
     * @var \DateTime
     */
    private $salida;

    /**
     * @var \ModeloBundle\Entity\Bitacora
     */
    private $idbitacora;

    /**
     * @var \ModeloBundle\Entity\Jugador
     */
    private $idjugador;

    /**
     * @var \ModeloBundle\Entity\Equipo
     */
    private $idequipo;

    /**
     * @var \ModeloBundle\Entity\Asociado
     */
    private $idasociado;

    /**
     * @var \ModeloBundle\Entity\Invitado
     */
    private $idinvitado;

    /**
     * @var \ModeloBundle\Entity\Socio
     */
    private $idsocio;

    /**
     * @var \ModeloBundle\Entity\Usuario
     */
    private $idusuario;


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
     * Set entrada
     *
     * @param \DateTime $entrada
     *
     * @return Registro
     */
    public function setEntrada($entrada)
    {
        $this->entrada = $entrada;

        return $this;
    }

    /**
     * Get entrada
     *
     * @return \DateTime
     */
    public function getEntrada()
    {
        return $this->entrada;
    }

    /**
     * Set salida
     *
     * @param \DateTime $salida
     *
     * @return Registro
     */
    public function setSalida($salida)
    {
        $this->salida = $salida;

        return $this;
    }

    /**
     * Get salida
     *
     * @return \DateTime
     */
    public function getSalida()
    {
        return $this->salida;
    }

    /**
     * Set idbitacora
     *
     * @param \ModeloBundle\Entity\Bitacora $idbitacora
     *
     * @return Registro
     */
    public function setIdbitacora(\ModeloBundle\Entity\Bitacora $idbitacora = null)
    {
        $this->idbitacora = $idbitacora;

        return $this;
    }

    /**
     * Get idbitacora
     *
     * @return \ModeloBundle\Entity\Bitacora
     */
    public function getIdbitacora()
    {
        return $this->idbitacora;
    }

    /**
     * Set idjugador
     *
     * @param \ModeloBundle\Entity\Jugador $idjugador
     *
     * @return Registro
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
     * @return Registro
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
     * Set idasociado
     *
     * @param \ModeloBundle\Entity\Asociado $idasociado
     *
     * @return Registro
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
     * Set idinvitado
     *
     * @param \ModeloBundle\Entity\Invitado $idinvitado
     *
     * @return Registro
     */
    public function setIdinvitado(\ModeloBundle\Entity\Invitado $idinvitado = null)
    {
        $this->idinvitado = $idinvitado;

        return $this;
    }

    /**
     * Get idinvitado
     *
     * @return \ModeloBundle\Entity\Invitado
     */
    public function getIdinvitado()
    {
        return $this->idinvitado;
    }

    /**
     * Set idsocio
     *
     * @param \ModeloBundle\Entity\Socio $idsocio
     *
     * @return Registro
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
     * Set idusuario
     *
     * @param \ModeloBundle\Entity\Usuario $idusuario
     *
     * @return Registro
     */
    public function setIdusuario(\ModeloBundle\Entity\Usuario $idusuario = null)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get idusuario
     *
     * @return \ModeloBundle\Entity\Usuario
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
}

