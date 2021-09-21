<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Annee;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdClasse;

    /**
     * @ORM\OneToMany(targetEntity=FicheInscription::class, mappedBy="Id_Inscription")
     */
    private $ficheInscriptions;

    public function __construct()
    {
        $this->ficheInscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?int
    {
        return $this->Annee;
    }

    public function setAnnee(int $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdClasse(): ?Classe
    {
        return $this->IdClasse;
    }

    public function setIdClasse(?Classe $IdClasse): self
    {
        $this->IdClasse = $IdClasse;

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
            $ficheInscription->setIdInscription($this);
        }

        return $this;
    }

    public function removeFicheInscription(FicheInscription $ficheInscription): self
    {
        if ($this->ficheInscriptions->removeElement($ficheInscription)) {
            // set the owning side to null (unless already changed)
            if ($ficheInscription->getIdInscription() === $this) {
                $ficheInscription->setIdInscription(null);
            }
        }

        return $this;
    }
}
