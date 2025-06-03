<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StageRepository::class)]
class Stage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $DateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $DateFin = null;

    #[ORM\OneToOne(mappedBy: 'refStage', cascade: ['persist', 'remove'])]
    private ?Etudiant $refEtudiant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->DateDebut;
    }

    public function setDateDebut(\DateTime $DateDebut): static
    {
        $this->DateDebut = $DateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->DateFin;
    }

    public function setDateFin(\DateTime $DateFin): static
    {
        $this->DateFin = $DateFin;

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
            $this->refEtudiant->setRefStage(null);
        }

        // set the owning side of the relation if necessary
        if ($refEtudiant !== null && $refEtudiant->getRefStage() !== $this) {
            $refEtudiant->setRefStage($this);
        }

        $this->refEtudiant = $refEtudiant;

        return $this;
    }
}
