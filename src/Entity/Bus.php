<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bus
 *
 * @ORM\Table(name="bus")
 * @ORM\Entity(repositoryClass="App\Repository\BusRepository")
 */
class Bus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_bus", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="bus_id_bus_seq", allocationSize=1, initialValue=1)
     */
    private $idBus;

    /**
     * @var string
     *
     * @ORM\Column(name="informacion", type="string", length=150, nullable=false)
     */
    private $informacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado_bus", type="string", length=50, nullable=true)
     */
    private $estadoBus;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado;

    public function getIdBus(): ?int
    {
        return $this->idBus;
    }

    public function getInformacion(): ?string
    {
        return $this->informacion;
    }

    public function setInformacion(?string $informacion): self
    {
        $this->informacion = $informacion;

        return $this;
    }

    public function getEstadoBus(): ?string
    {
        return $this->estadoBus;
    }

    public function setEstadoBus(?string $estadoBus): self
    {
        $this->estadoBus = $estadoBus;

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


}
