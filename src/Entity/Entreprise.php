<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Siret = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\OneToOne(mappedBy: 'refEntreprise', cascade: ['persist', 'remove'])]
    private ?Alternance $refAlternance = null;
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

    public function getSiret(): ?string
    {
        return $this->Siret;
    }

    public function setSiret(string $Siret): static
    {
        $this->Siret = $Siret;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getRefAlternance(): ?Alternance
    {
        return $this->refAlternance;
    }

    public function setRefAlternance(Alternance $refAlternance): static
    {
        // set the owning side of the relation if necessary
        if ($refAlternance->getRefEntreprise() !== $this) {
            $refAlternance->setRefEntreprise($this);
        }

        $this->refAlternance = $refAlternance;

        return $this;
    }
}
