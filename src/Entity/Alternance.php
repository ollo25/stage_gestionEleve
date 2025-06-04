<?php

namespace App\Entity;

use App\Repository\AlternanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlternanceRepository::class)]
class Alternance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $DateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $DateFin = null;

    #[ORM\Column]
    private ?float $CoutContrat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TuteurProfesseur = null;

    /**
     * @var Collection<int, Etudiant>
     */
    #[ORM\OneToMany(targetEntity: Etudiant::class, mappedBy: 'refAlternance')]
    private Collection $etudiants;

    #[ORM\ManyToOne(inversedBy: 'alternances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $refEntreprise = null;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

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

    public function getCoutContrat(): ?float
    {
        return $this->CoutContrat;
    }

    public function setCoutContrat(float $CoutContrat): static
    {
        $this->CoutContrat = $CoutContrat;

        return $this;
    }

    public function getTuteurProfesseur(): ?string
    {
        return $this->TuteurProfesseur;
    }

    public function setTuteurProfesseur(string $TuteurProfesseur): static
    {
        $this->TuteurProfesseur = $TuteurProfesseur;

        return $this;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): static
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants->add($etudiant);
            $etudiant->setRefAlternance($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): static
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getRefAlternance() === $this) {
                $etudiant->setRefAlternance(null);
            }
        }

        return $this;
    }

    public function getRefEntreprise(): ?Entreprise
    {
        return $this->refEntreprise;
    }

    public function setRefEntreprise(?Entreprise $refEntreprise): static
    {
        $this->refEntreprise = $refEntreprise;

        return $this;
    }
}
