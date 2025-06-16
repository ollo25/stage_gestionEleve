<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
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

    #[ORM\Column(length: 50)]
    private ?string $telephone = null;

    /**
     * @var Collection<int, Convocation>
     */
    #[ORM\OneToMany(targetEntity: Convocation::class, mappedBy: 'refEtudiant')]
    private Collection $convocations;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Stage $refStage = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Alternance $refAlternance = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Promotion $refPromotion = null;

    public function __construct()
    {
        $this->convocations = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Convocation>
     */
    public function getConvocations(): Collection
    {
        return $this->convocations;
    }

    public function addConvocation(Convocation $convocation): static
    {
        if (!$this->convocations->contains($convocation)) {
            $this->convocations->add($convocation);
            $convocation->setRefEtudiant($this);
        }

        return $this;
    }

    public function removeConvocation(Convocation $convocation): static
    {
        if ($this->convocations->removeElement($convocation)) {
            // set the owning side to null (unless already changed)
            if ($convocation->getRefEtudiant() === $this) {
                $convocation->setRefEtudiant(null);
            }
        }

        return $this;
    }

    public function getRefStage(): ?Stage
    {
        return $this->refStage;
    }

    public function setRefStage(?Stage $refStage): static
    {
        $this->refStage = $refStage;

        return $this;
    }

    public function getRefAlternance(): ?Alternance
    {
        return $this->refAlternance;
    }

    public function setRefAlternance(?Alternance $refAlternance): static
    {
        $this->refAlternance = $refAlternance;

        return $this;
    }

    public function getRefPromotion(): ?Promotion
    {
        return $this->refPromotion;
    }

    public function setRefPromotion(?Promotion $refPromotion): static
    {
        $this->refPromotion = $refPromotion;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom()." ".$this->getPrenom();
    }
    public function hasConvocationActive(){
        $nbConvocs =0;
        foreach ($this->convocations as $convocation) {
            if ($convocation->estOuverte()) {
                $nbConvocs++;
            }
        }
        return $nbConvocs;
    }
}
