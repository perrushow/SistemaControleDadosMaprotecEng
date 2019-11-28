<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClienteRepository")
 */
class Cliente
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $clinome;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $telefone;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Planos", inversedBy="clientes_idclientes")
     */
    private $planos_idplanos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consulta", mappedBy="cliente_idcliente")
     */
    private $consulta_idconsulta;

    public function __construct()
    {
        $this->planos_idplanos = new ArrayCollection(); //metodo construtor
        $this->consulta_idconsulta = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClinome(): ?string
    {
        return $this->clinome;
    }

    public function setClinome(string $clinome): self
    {
        $this->clinome = $clinome;
        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): self
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return Collection|planos[]
     */
    public function getPlanosIdplanos(): Collection
    {
        return $this->planos_idplanos;
    }

    public function addPlanosIdplano(planos $planosIdplano): self
    {
        if (!$this->planos_idplanos->contains($planosIdplano)) {
            $this->planos_idplanos[] = $planosIdplano;
        }
        return $this;
    }

    public function removePlanosIdplano(planos $planosIdplano): self
    {
        if ($this->planos_idplanos->contains($planosIdplano)) {
            $this->planos_idplanos->removeElement($planosIdplano);
        }
        return $this;
    }

    /**
     * @return Collection|Consulta[]
     */
    public function getConsultaIdconsulta(): Collection
    {
        return $this->consulta_idconsulta;
    }
    public function addConsultaIdconsultum(Consulta $consultaIdconsultum): self
    {
        if (!$this->consulta_idconsulta->contains($consultaIdconsultum)) {
            $this->consulta_idconsulta[] = $consultaIdconsultum;
            $consultaIdconsultum->setClienteIdcliente($this);
        }
        return $this;
    }

    public function removeConsultaIdconsultum(Consulta $consultaIdconsultum): self
    {
        if ($this->consulta_idconsulta->contains($consultaIdconsultum)) {
            $this->consulta_idconsulta->removeElement($consultaIdconsultum);
            // set the owning side to null (unless already changed)
            if ($consultaIdconsultum->getClienteIdcliente() === $this) {
                $consultaIdconsultum->setClienteIdcliente(null);
            }
        }
        return $this;
    }
}