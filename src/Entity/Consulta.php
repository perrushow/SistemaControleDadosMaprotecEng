<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

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
     * @ORM\Column(type="date")
     */
    private $dia_consulta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="consulta_idconsulta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente_idcliente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HorariosMedico", inversedBy="consulta_idconsulta")
     */
    private $horarios_medico_idhorariosmedico;

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

    public function getDiaConsulta(): ?\DateTime
    {
        return $this->dia_consulta;
    }

    public function setDiaConsulta(\DateTime $dia_consulta): self
    {
        $this->dia_consulta = $dia_consulta;
        return $this;
    }

    public function getHorariosMedicoIdhorariosmedico(): ?HorariosMedico
    {
        return $this->horarios_medico_idhorariosmedico;
    }

    public function setHorariosMedicoIdhorariosmedico(?HorariosMedico $horarios_medico_idhorariosmedico): self
    {
        $this->horarios_medico_idhorariosmedico = $horarios_medico_idhorariosmedico;
        return $this;
    }

}