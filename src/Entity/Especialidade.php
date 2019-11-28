<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EspecialidadeRepository")
 */
class Especialidade
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
    private $esnome;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Medico", mappedBy="especialidade_idespecialidade")
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

    public function getEsnome(): ?string
    {
        return $this->esnome;
    }

    public function setEsnome(string $esnome): self
    {
        $this->esnome = $esnome;
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
            $medicoIdmedico->addEspecialidadeIdespecialidade($this);
        }
        return $this;
    }

    public function removeMedicoIdmedico(Medico $medicoIdmedico): self
    {
        if ($this->medico_idmedico->contains($medicoIdmedico)) {
            $this->medico_idmedico->removeElement($medicoIdmedico);
            $medicoIdmedico->removeEspecialidadeIdespecialidade($this);
        }
        return $this;
    }
}