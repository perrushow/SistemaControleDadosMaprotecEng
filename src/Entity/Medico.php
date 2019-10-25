<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicoRepository")
 */
class Medico
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
    private $menome;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $dia1;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $dia2;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $dia3;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $dia4;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $dia5;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Especialidade", inversedBy="medico_idmedico")
     */
    private $especialidade_idespecialidade;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\HorariosMedico", inversedBy="medico_idmedico")
     */
    private $horario_medico_idhorariomedico;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consulta", mappedBy="medico_idmedico")
     */
    private $consulta_idconsulta;

    public function __construct()
    {
        $this->especialidade_idespecialidade = new ArrayCollection();
        $this->horario_medico_idhorariomedico = new ArrayCollection();
        $this->consulta_idconsulta = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenome(): ?string
    {
        return $this->menome;
    }

    public function setMenome(string $menome): self
    {
        $this->menome = $menome;

        return $this;
    }

    public function getDia1(): ?string
    {
        return $this->dia1;
    }

    public function setDia1(?string $dia1): self
    {
        $this->dia1 = $dia1;

        return $this;
    }

    public function getDia2(): ?string
    {
        return $this->dia2;
    }

    public function setDia2(?string $dia2): self
    {
        $this->dia2 = $dia2;

        return $this;
    }

    public function getDia3(): ?string
    {
        return $this->dia3;
    }

    public function setDia3(?string $dia3): self
    {
        $this->dia3 = $dia3;

        return $this;
    }

    public function getDia4(): ?string
    {
        return $this->dia4;
    }

    public function setDia4(?string $dia4): self
    {
        $this->dia4 = $dia4;

        return $this;
    }

    public function getDia5(): ?string
    {
        return $this->dia5;
    }

    public function setDia5(?string $dia5): self
    {
        $this->dia5 = $dia5;

        return $this;
    }

    /**
     * @return Collection|Especialidade[]
     */
    public function getEspecialidadeIdespecialidade(): Collection
    {
        return $this->especialidade_idespecialidade;
    }

    public function addEspecialidadeIdespecialidade(Especialidade $especialidadeIdespecialidade): self
    {
        if (!$this->especialidade_idespecialidade->contains($especialidadeIdespecialidade)) {
            $this->especialidade_idespecialidade[] = $especialidadeIdespecialidade;
        }

        return $this;
    }

    public function removeEspecialidadeIdespecialidade(Especialidade $especialidadeIdespecialidade): self
    {
        if ($this->especialidade_idespecialidade->contains($especialidadeIdespecialidade)) {
            $this->especialidade_idespecialidade->removeElement($especialidadeIdespecialidade);
        }

        return $this;
    }

    /**
     * @return Collection|HorariosMedico[]
     */
    public function getHorarioMedicoIdhorariomedico(): Collection
    {
        return $this->horario_medico_idhorariomedico;
    }


    public function addHorarioMedicoIdhorariomedico(HorariosMedico $horarioMedicoIdhorariomedico): self
    {
        if (!$this->horario_medico_idhorariomedico->contains($horarioMedicoIdhorariomedico)) {
            $this->horario_medico_idhorariomedico[] = $horarioMedicoIdhorariomedico;
        }

        return $this;
    }

    public function removeHorarioMedicoIdhorariomedico(HorariosMedico $horarioMedicoIdhorariomedico): self
    {
        if ($this->horario_medico_idhorariomedico->contains($horarioMedicoIdhorariomedico)) {
            $this->horario_medico_idhorariomedico->removeElement($horarioMedicoIdhorariomedico);
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
            $consultaIdconsultum->setMedicoIdmedico($this);
        }

        return $this;
    }

    public function removeConsultaIdconsultum(Consulta $consultaIdconsultum): self
    {
        if ($this->consulta_idconsulta->contains($consultaIdconsultum)) {
            $this->consulta_idconsulta->removeElement($consultaIdconsultum);
            // set the owning side to null (unless already changed)
            if ($consultaIdconsultum->getMedicoIdmedico() === $this) {
                $consultaIdconsultum->setMedicoIdmedico(null);
            }
        }

        return $this;
    }
}
