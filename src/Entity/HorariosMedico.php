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
     * @ORM\Column(type="string", length=11)
     */
    private $hora;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Medico", mappedBy="horario_medico_idhorariomedico")
     */
    private $medico_idmedico;

    public function __construct()
    {
        $this->medico_idmedico = new ArrayCollection();
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
    public function getMedicoIdmedico(): Collection
    {
        return $this->medico_idmedico;
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
}
