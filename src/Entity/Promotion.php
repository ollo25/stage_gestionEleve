<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Filiere = null;

    #[ORM\Column(length: 255)]
    private ?string $Annee = null;

    #[ORM\Column]
    private ?int $Places = null;

    #[ORM\OneToOne(mappedBy: 'refPromotion', cascade: ['persist', 'remove'])]
    private ?Etudiant $refEtudiant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFiliere(): ?string
    {
        return $this->Filiere;
    }

    public function setFiliere(string $Filiere): static
    {
        $this->Filiere = $Filiere;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->Annee;
    }

    public function setAnnee(string $Annee): static
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->Places;
    }

    public function setPlaces(int $Places): static
    {
        $this->Places = $Places;

        return $this;
    }

    public function getRefEtudiant(): ?Etudiant
    {
        return $this->refEtudiant;
    }

    public function setRefEtudiant(Etudiant $refEtudiant): static
    {
        // set the owning side of the relation if necessary
        if ($refEtudiant->getRefPromotion() !== $this) {
            $refEtudiant->setRefPromotion($this);
        }

        $this->refEtudiant = $refEtudiant;

        return $this;
    }
}
