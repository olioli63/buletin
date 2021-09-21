<?php

namespace App\Entity;

use App\Repository\FicheInscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FicheInscriptionRepository::class)
 */
class FicheInscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Inscription::class, inversedBy="ficheInscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Id_Inscription;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\ManyToOne(targetEntity=Eleve::class, inversedBy="ficheInscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdEleve;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="ficheInscriptions")
     */
    private $NomClasse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Remarque;

    /**
     * @ORM\OneToMany(targetEntity=Passants::class, mappedBy="FicheInscription", orphanRemoval=true)
     */
    private $passants;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="IdFiche", orphanRemoval=true)
     */
    private $notes;



    public function __construct()
    {
        $this->passants = new ArrayCollection();
        $this->notes = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString()
    {
        return $this->FicheInscription;
    }
    public function getIdInscription(): ?Inscription
    {
        return $this->Id_Inscription;
    }


    public function setIdInscription(?Inscription $Id_Inscription): self
    {
        $this->Id_Inscription = $Id_Inscription;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getIdEleve(): ?Eleve
    {
        return $this->IdEleve;
    }

    public function setIdEleve(?Eleve $IdEleve): self
    {
        $this->IdEleve = $IdEleve;

        return $this;
    }

    public function getNomClasse(): ?Classe
    {
        return $this->NomClasse;
    }

    public function setNomClasse(?Classe $NomClasse): self
    {
        $this->NomClasse = $NomClasse;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->Remarque;
    }

    public function setRemarque(string $Remarque): self
    {
        $this->Remarque = $Remarque;

        return $this;
    }

  

    /**
     * @return Collection|Passants[]
     */
    public function getPassants(): Collection
    {
        return $this->passants;
    }

    public function addPassant(Passants $passant): self
    {
        if (!$this->passants->contains($passant)) {
            $this->passants[] = $passant;
            $passant->setIdFicheInscription($this);
        }

        return $this;
    }

    public function removePassant(Passants $passant): self
    {
        if ($this->passants->removeElement($passant)) {
            // set the owning side to null (unless already changed)
            if ($passant->getIdFicheInscription() === $this) {
                $passant->setIdFicheInscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setIdFiche($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getIdFiche() === $this) {
                $note->setIdFiche(null);
            }
        }

        return $this;
    }

   
 
}
