<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 */
class Eleve
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Sexe;

    /**
     * @ORM\Column(type="integer")
     */
    private $Contact;

    /**
     * @ORM\OneToMany(targetEntity=FicheInscription::class, mappedBy="IdEleve")
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

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(string $Sexe): self
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getContact(): ?int
    {
        return $this->Contact;
    }

    public function setContact(int $Contact): self
    {
        $this->Contact = $Contact;

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
            $ficheInscription->setIdEleve($this);
        }

        return $this;
    }

    public function removeFicheInscription(FicheInscription $ficheInscription): self
    {
        if ($this->ficheInscriptions->removeElement($ficheInscription)) {
            // set the owning side to null (unless already changed)
            if ($ficheInscription->getIdEleve() === $this) {
                $ficheInscription->setIdEleve(null);
            }
        }

        return $this;
    }
}
