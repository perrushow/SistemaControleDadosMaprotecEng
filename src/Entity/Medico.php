<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

// retirado os dias da tabela medico Pois nao ha necessidade desses dados, eles fazem parte da relacao entre as tabelas medico e horarios medico

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
     * @ORM\ManyToMany(targetEntity="App\Entity\Especialidade", inversedBy="medico_idmedico")
     * @ORM\JoinTable(name="especialidade_medico",
     *      joinColumns={@ORM\JoinColumn(name="medico_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="especialidade_id", referencedColumnName="id")}
     *      )
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

    public function setHorarioMedicoIdhorariomedico($horario_medico_idhorariomedico)
    {
        $this->horario_medico_idhorariomedico = new ArrayCollection();
        foreach ($horario_medico_idhorariomedico as $horario) {
            $this->addHorarioMedicoIdhorariomedico($horario);
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