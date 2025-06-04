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
    private ?\DateTime $Date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Motif = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $ActionMiseEnPlace = null;

    #[ORM\ManyToOne(inversedBy: 'convocations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $refResponsable = null;

    #[ORM\ManyToOne(inversedBy: 'convocations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $refEtudiant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->Date;
    }

    public function setDate(\DateTime $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->Motif;
    }

    public function setMotif(?string $Motif): static
    {
        $this->Motif = $Motif;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getActionMiseEnPlace(): ?string
    {
        return $this->ActionMiseEnPlace;
    }

    public function setActionMiseEnPlace(?string $ActionMiseEnPlace): static
    {
        $this->ActionMiseEnPlace = $ActionMiseEnPlace;

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
}
