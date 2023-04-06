<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unidad
 *
 * @ORM\Table(name="unidad")
 * @ORM\Entity
 */
class Unidad
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_unidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="unidad_id_unidad_seq", allocationSize=1, initialValue=1)
     */
    private $idUnidad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codigo", type="string", length=5, nullable=true)
     */
    private $codigo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="capacidad", type="integer", nullable=true)
     */
    private $capacidad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="placa", type="string", length=7, nullable=true)
     */
    private $placa;

    public function getIdUnidad(): ?int
    {
        return $this->idUnidad;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getCapacidad(): ?int
    {
        return $this->capacidad;
    }

    public function setCapacidad(?int $capacidad): self
    {
        $this->capacidad = $capacidad;

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

    public function getPlaca(): ?string
    {
        return $this->placa;
    }

    public function setPlaca(?string $placa): self
    {
        $this->placa = $placa;

        return $this;
    }


}
