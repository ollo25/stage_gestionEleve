<?php

namespace App\Entity;

use App\Repository\PotentielEleveRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PotentielEleveRepository::class)]
class PotentielEleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 20)]
    private ?string $telephone = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $numDossierPsup = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filiereEnvisage = null;

    #[ORM\Column(length: 255)]
    private ?string $ancienEtablissement = null;

    #[ORM\ManyToOne(inversedBy: 'refPotentielEleve')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $refResponsable = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNumDossierPsup(): ?string
    {
        return $this->numDossierPsup;
    }

    public function setNumDossierPsup(?string $numDossierPsup): static
    {
        $this->numDossierPsup = $numDossierPsup;

        return $this;
    }

    public function getFiliereEnvisage(): ?string
    {
        return $this->filiereEnvisage;
    }

    public function setFiliereEnvisage(?string $filiereEnvisage): static
    {
        $this->filiereEnvisage = $filiereEnvisage;

        return $this;
    }

    public function getAncienEtablissement(): ?string
    {
        return $this->ancienEtablissement;
    }

    public function setAncienEtablissement(string $ancienEtablissement): static
    {
        $this->ancienEtablissement = $ancienEtablissement;

        return $this;
    }

    public function getRefResponsable(): ?User
    {
        return $this->refResponsable;
    }

    public function setRefResponsable(?User $refResponsable): static
    {
        $this->refResponsable = $refResponsable;

        return $this;
    }
}
