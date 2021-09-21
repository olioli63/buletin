<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
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
    private $Matiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $Coeff;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Professeur;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="matiere", orphanRemoval=true)
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString()
    {
        return $this->Matiere;
    }

    public function getMatiere(): ?string
    {
        return $this->Matiere;
    }

    public function setMatiere(string $Matiere): self
    {
        $this->Matiere = $Matiere;

        return $this;
    }

    public function getCoeff(): ?int
    {
        return $this->Coeff;
    }

    public function setCoeff(int $Coeff): self
    {
        $this->Coeff = $Coeff;

        return $this;
    }

    public function getProfesseur(): ?string
    {
        return $this->Professeur;
    }

    public function setProfesseur(string $Professeur): self
    {
        $this->Professeur = $Professeur;

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
            $note->setMatiere($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getMatiere() === $this) {
                $note->setMatiere(null);
            }
        }

        return $this;
    }

}
