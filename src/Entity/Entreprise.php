<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Stage>
     */
    #[ORM\OneToMany(targetEntity: Stage::class, mappedBy: 'refEntreprise')]
    private Collection $stages;

    /**
     * @var Collection<int, Alternance>
     */
    #[ORM\OneToMany(targetEntity: Alternance::class, mappedBy: 'refEntreprise')]
    private Collection $alternances;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
        $this->alternances = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Stage>
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): static
    {
        if (!$this->stages->contains($stage)) {
            $this->stages->add($stage);
            $stage->setRefEntreprise($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): static
    {
        if ($this->stages->removeElement($stage)) {
            // set the owning side to null (unless already changed)
            if ($stage->getRefEntreprise() === $this) {
                $stage->setRefEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Alternance>
     */
    public function getAlternances(): Collection
    {
        return $this->alternances;
    }

    public function addAlternance(Alternance $alternance): static
    {
        if (!$this->alternances->contains($alternance)) {
            $this->alternances->add($alternance);
            $alternance->setRefEntreprise($this);
        }

        return $this;
    }

    public function removeAlternance(Alternance $alternance): static
    {
        if ($this->alternances->removeElement($alternance)) {
            // set the owning side to null (unless already changed)
            if ($alternance->getRefEntreprise() === $this) {
                $alternance->setRefEntreprise(null);
            }
        }

        return $this;
    }
}
