<?php

namespace App\Entity;

use App\Repository\PassantsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PassantsRepository::class)
 */
class Passants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=FicheInscription::class, inversedBy="passants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Id_Fiche_Inscription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Observation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFicheInscription(): ?FicheInscription
    {
        return $this->Id_Fiche_Inscription;
    }

    public function setIdFicheInscription(?FicheInscription $Id_Fiche_Inscription): self
    {
        $this->Id_Fiche_Inscription = $Id_Fiche_Inscription;

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
}
