<?php

namespace App\Entity;

use App\Repository\ConvocationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConvocationRepository::class)]
class Convocation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $motif = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $actionMiseEnPlace = null;

    #[ORM\ManyToOne(inversedBy: 'convocations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $refResponsable = null;

    #[ORM\ManyToOne(inversedBy: 'convocations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $refEtudiant = null;

    #[ORM\Column]
    private ?bool $estOuverte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setdate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(?string $motif): static
    {
        $this->motif = $motif;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getActionMiseEnPlace(): ?string
    {
        return $this->actionMiseEnPlace;
    }

    public function setActionMiseEnPlace(?string $actionMiseEnPlace): static
    {
        $this->actionMiseEnPlace = $actionMiseEnPlace;

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

    public function getRefEtudiant(): ?Etudiant
    {
        return $this->refEtudiant;
    }

    public function setRefEtudiant(?Etudiant $refEtudiant): static
    {
        $this->refEtudiant = $refEtudiant;

        return $this;
    }

    public function estOuverte(): ?bool
    {
        return $this->estOuverte;
    }

    public function setEstOuverte(bool $estOuverte): static
    {
        $this->estOuverte = $estOuverte;

        return $this;
    }
}
