<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva", indexes={@ORM\Index(name="IDX_188D2E3BB1F28333", columns={"id_bus"}), @ORM\Index(name="IDX_188D2E3BFCF8192D", columns={"id_usuario"})})
 * @ORM\Entity(repositoryClass="App\Repository\ReservaRepository")
 */
class Reserva
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reserva", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="reserva_id_reserva_seq", allocationSize=1, initialValue=1)
     */
    private $idReserva;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacion", type="string", length=250, nullable=true)
     */
    private $observacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado_reserva", type="string", length=150, nullable=true)
     */
    private $estadoReserva;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado;
 /**
     * @var DateTime|null 
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $horario;
    /**
     * @var \Bus
     *
     * @ORM\ManyToOne(targetEntity="Bus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_bus", referencedColumnName="id_bus")
     * })
     */
    private $idBus;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    public function getIdReserva(): ?int
    {
        return $this->idReserva;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }

    public function getEstadoReserva(): ?string
    {
        return $this->estadoReserva;
    }

    public function setEstadoReserva(?string $estadoReserva): self
    {
        $this->estadoReserva = $estadoReserva;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIdBus(): ?Bus
    {
        return $this->idBus;
    }

    public function setIdBus(?Bus $idBus): self
    {
        $this->idBus = $idBus;

        return $this;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    public function getHorario(): ?\DateTimeInterface
    {
        return $this->horario;
    }

    public function setHorario(\DateTimeInterface $horario): self
    {
        $this->horario = $horario;

        return $this;
    }
}
