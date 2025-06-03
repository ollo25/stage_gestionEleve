<?php

namespace App\Entity;

use App\Repository\AlternanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlternanceRepository::class)]
class Alternance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $DateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $DateFin = null;

    #[ORM\Column(nullable: true)]
    private ?float $coutContrat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tuteurProfesseur = null;

    #[ORM\OneToOne(inversedBy: 'refAlternance', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $refEntreprise = null;

    #[ORM\OneToOne(mappedBy: 'refAlternance', cascade: ['persist', 'remove'])]
    private ?Etudiant $refEtudiant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->DateDebut;
    }

    public function setDateDebut(?\DateTime $DateDebut): static
    {
        $this->DateDebut = $DateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->DateFin;
    }

    public function setDateFin(?\DateTime $DateFin): static
    {
        $this->DateFin = $DateFin;

        return $this;
    }

    public function getCoutContrat(): ?float
    {
        return $this->coutContrat;
    }

    public function setCoutContrat(?float $coutContrat): static
    {
        $this->coutContrat = $coutContrat;

        return $this;
    }

    public function getTuteurProfesseur(): ?string
    {
        return $this->tuteurProfesseur;
    }

    public function setTuteurProfesseur(?string $tuteurProfesseur): static
    {
        $this->tuteurProfesseur = $tuteurProfesseur;

        return $this;
    }

    public function getRefEntreprise(): ?Entreprise
    {
        return $this->refEntreprise;
    }

    public function setRefEntreprise(Entreprise $refEntreprise): static
    {
        $this->refEntreprise = $refEntreprise;

        return $this;
    }

    public function getRefEtudiant(): ?Etudiant
    {
        return $this->refEtudiant;
    }

    public function setRefEtudiant(?Etudiant $refEtudiant): static
    {
        // unset the owning side of the relation if necessary
        if ($refEtudiant === null && $this->refEtudiant !== null) {
            $this->refEtudiant->setRefAlternance(null);
        }

        // set the owning side of the relation if necessary
        if ($refEtudiant !== null && $refEtudiant->getRefAlternance() !== $this) {
            $refEtudiant->setRefAlternance($this);
        }

        $this->refEtudiant = $refEtudiant;

        return $this;
    }
}
