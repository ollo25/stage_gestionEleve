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

    #[ORM\Column(length: 255)]
    private ?string $Telephone = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $NumDossierPsup = null;

    #[ORM\Column(length: 100)]
    private ?string $FiliereEnvisage = null;

    #[ORM\Column(length: 255)]
    private ?string $AncienEtablissement = null;

    #[ORM\ManyToOne(inversedBy: 'potentielEleves')]
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
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): static
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getNumDossierPsup(): ?string
    {
        return $this->NumDossierPsup;
    }

    public function setNumDossierPsup(string $NumDossierPsup): static
    {
        $this->NumDossierPsup = $NumDossierPsup;

        return $this;
    }

    public function getFiliereEnvisage(): ?string
    {
        return $this->FiliereEnvisage;
    }

    public function setFiliereEnvisage(string $FiliereEnvisage): static
    {
        $this->FiliereEnvisage = $FiliereEnvisage;

        return $this;
    }

    public function getAncienEtablissement(): ?string
    {
        return $this->AncienEtablissement;
    }

    public function setAncienEtablissement(string $AncienEtablissement): static
    {
        $this->AncienEtablissement = $AncienEtablissement;

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
