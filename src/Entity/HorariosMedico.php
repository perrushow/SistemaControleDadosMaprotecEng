<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HorariosMedicoRepository")
 */
class HorariosMedico
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $dia;

    /**
     * @ORM\Column(type="array")
     */
    private $hora;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Medico", mappedBy="horario_medico_idhorariomedico")
     * @ORM\JoinTable(name="medico_horarios_medico",
     *      joinColumns={@ORM\JoinColumn(name="horarios_medico_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="medico_id", referencedColumnName="id")}
     *      )
     */
    private $medico_idmedico;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consulta", mappedBy="horarios_medico_idhorariosmedico")
     */
    private $consulta_idconsulta;

    public function __construct()
    {
        $this->medico_idmedico = new ArrayCollection();
        $this->consulta_idconsulta = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDia(): ?string
    {
        return $this->dia;
    }

    public function setDia(string $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    public function getHora(): ?string
    {
        return $this->hora;
    }

    public function setHora(string $hora): self
    {
        $this->hora = $hora;
        return $this;
    }

    /**
     * @return Collection|Medico[]
     */
    public function getMedicoIdmedico()
    {
        return $this->medico_idmedico;
    }

    public function setMedicoIdmedico(\Doctrine\Common\Collections\Collection $medico_idmedico)
    {
        $this->medico_idmedico = $medico_idmedico;
    }

    public function addMedicoIdmedico(Medico $medicoIdmedico): self
    {
        if (!$this->medico_idmedico->contains($medicoIdmedico)) {
            $this->medico_idmedico[] = $medicoIdmedico;
            $medicoIdmedico->addHorarioMedicoIdhorariomedico($this);
        }
        return $this;
    }

    public function removeMedicoIdmedico(Medico $medicoIdmedico): self
    {
        if ($this->medico_idmedico->contains($medicoIdmedico)) {
            $this->medico_idmedico->removeElement($medicoIdmedico);
            $medicoIdmedico->removeHorarioMedicoIdhorariomedico($this);
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
            $consultaIdconsultum->setHorariosMedicoIdhorariosmedico($this);
        }
        return $this;
    }

    public function removeConsultaIdconsultum(Consulta $consultaIdconsultum): self
    {
        if ($this->consulta_idconsulta->contains($consultaIdconsultum)) {
            $this->consulta_idconsulta->removeElement($consultaIdconsultum);
            if ($consultaIdconsultum->getHorariosMedicoIdhorariosmedico() === $this) {
                $consultaIdconsultum->setHorariosMedicoIdhorariosmedico(null);
            }
        }
        return $this;
    }
}