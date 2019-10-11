<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsultaRepository")
 */
class Consulta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medico", inversedBy="consulta_idconsulta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $medico_idmedico;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="consulta_idconsulta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente_idcliente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicoIdmedico(): ?Medico
    {
        return $this->medico_idmedico;
    }

    public function setMedicoIdmedico(?Medico $medico_idmedico): self
    {
        $this->medico_idmedico = $medico_idmedico;

        return $this;
    }

    public function getClienteIdcliente(): ?Cliente
    {
        return $this->cliente_idcliente;
    }

    public function setClienteIdcliente(?Cliente $cliente_idcliente): self
    {
        $this->cliente_idcliente = $cliente_idcliente;

        return $this;
    }
}
