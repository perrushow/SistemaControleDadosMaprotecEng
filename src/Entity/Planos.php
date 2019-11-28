<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlanosRepository")
 */
class Planos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $planome;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cliente", mappedBy="planos_idplanos")
     */
    private $clientes_idclientes;

    public function __construct()
    {
        $this->clientes_idclientes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlanome(): ?string
    {
        return $this->planome;
    }

    public function setPlanome(string $planome): self
    {
        $this->planome = $planome;
        return $this;
    }

    /**
     * @return Collection|Cliente[]
     */
    public function getClientesIdclientes(): Collection
    {
        return $this->clientes_idclientes;
    }

    public function addClientesIdcliente(Cliente $clientesIdcliente): self
    {
        if (!$this->clientes_idclientes->contains($clientesIdcliente)) {
            $this->clientes_idclientes[] = $clientesIdcliente;
            $clientesIdcliente->addPlanosIdplano($this);
        }
        return $this;
    }

    public function removeClientesIdcliente(Cliente $clientesIdcliente): self
    {
        if ($this->clientes_idclientes->contains($clientesIdcliente)) {
            $this->clientes_idclientes->removeElement($clientesIdcliente);
            $clientesIdcliente->removePlanosIdplano($this);
        }
        return $this;
    }
}