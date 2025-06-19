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
    private ?\DateTime $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateFin = null;

    #[ORM\Column]
    private ?float $coutContrat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tuteurProfesseur = null;

    /**
     * @var Collection<int, Etudiant>
     */
    #[ORM\OneToMany(targetEntity: Etudiant::class, mappedBy: 'refAlternance')]
    private Collection $etudiants;

    #[ORM\ManyToOne(inversedBy: 'alternances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $refEntreprise = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $poste = null;

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
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTime $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTime $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getCoutContrat(): ?float
    {
        return $this->coutContrat;
    }

    public function setCoutContrat(float $coutContrat): static
    {
        $this->coutContrat = $coutContrat;

        return $this;
    }

    public function getTuteurProfesseur(): ?string
    {
        return $this->tuteurProfesseur;
    }

    public function setTuteurProfesseur(string $tuteurProfesseur): static
    {
        $this->tuteurProfesseur = $tuteurProfesseur;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getRefEntreprise()->getNom()." - ".$this->getPoste(). " - ".$this->coutContrat."€";
    }
}
