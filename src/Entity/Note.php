<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $Valeur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Observation;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiere;

    /**
     * @ORM\ManyToOne(targetEntity=FicheInscription::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdFiche;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?float
    {
        return $this->Valeur;
    }

    public function setValeur(float $Valeur): self
    {
        $this->Valeur = $Valeur;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->Observation;
    }

    public function setObservation(string $Observation): self
    {
        $this->Observation = $Observation;

        return $this;
    }


    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getIdFiche(): ?FicheInscription
    {
        return $this->IdFiche;
    }

    public function setIdFiche(?FicheInscription $IdFiche): self
    {
        $this->IdFiche = $IdFiche;

        return $this;
    }


}