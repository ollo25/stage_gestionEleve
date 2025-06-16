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
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $numDossierPsup = null;

    #[ORM\Column(length: 100)]
    private ?string $filiereEnvisage = null;

    #[ORM\Column(length: 255)]
    private ?string $ancienEtablissement = null;

    #[ORM\ManyToOne(inversedBy: 'potentielEleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $refResponsable = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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

    public function setNumDossierPsup(string $numDossierPsup): static
    {
        $this->numDossierPsup = $numDossierPsup;

        return $this;
    }

    public function getFiliereEnvisage(): ?string
    {
        return $this->filiereEnvisage;
    }

    public function setFiliereEnvisage(string $filiereEnvisage): static
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
