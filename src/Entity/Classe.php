<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Niveau;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Section;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="IdClasse", orphanRemoval=true)
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity=FicheInscription::class, mappedBy="NomClasse")
     */
    private $ficheInscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->ficheInscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?string
    {
        return $this->Niveau;
    }

    public function setNiveau(string $Niveau): self
    {
        $this->Niveau = $Niveau;

        return $this;
    }

    public function getSection(): ?string
    {
        return $this->Section;
    }

    public function setSection(string $Section): self
    {
        $this->Section = $Section;

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setIdClasse($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getIdClasse() === $this) {
                $inscription->setIdClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FicheInscription[]
     */
    public function getFicheInscriptions(): Collection
    {
        return $this->ficheInscriptions;
    }

    public function addFicheInscription(FicheInscription $ficheInscription): self
    {
        if (!$this->ficheInscriptions->contains($ficheInscription)) {
            $this->ficheInscriptions[] = $ficheInscription;
            $ficheInscription->setNomClasse($this);
        }

        return $this;
    }

    public function removeFicheInscription(FicheInscription $ficheInscription): self
    {
        if ($this->ficheInscriptions->removeElement($ficheInscription)) {
            // set the owning side to null (unless already changed)
            if ($ficheInscription->getNomClasse() === $this) {
                $ficheInscription->setNomClasse(null);
            }
        }

        return $this;
    }
}
