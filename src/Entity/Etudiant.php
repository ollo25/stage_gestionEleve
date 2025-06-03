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
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 20)]
    private ?string $Telephone = null;

    #[ORM\OneToOne(inversedBy: 'refEtudiant', cascade: ['persist', 'remove'])]
    private ?Stage $refStage = null;

    /**
     * @var Collection<int, Convocation>
     */
    #[ORM\OneToMany(targetEntity: Convocation::class, mappedBy: 'refConvocation')]
    private Collection $refConvocation;

    #[ORM\OneToOne(inversedBy: 'refEtudiant', cascade: ['persist', 'remove'])]
    private ?Alternance $refAlternance = null;

    #[ORM\OneToOne(inversedBy: 'refEtudiant', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Promotion $refPromotion = null;

    public function __construct()
    {
        $this->refConvocation = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): static
    {
        $this->Telephone = $Telephone;

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

    /**
     * @return Collection<int, Convocation>
     */
    public function getRefConvocation(): Collection
    {
        return $this->refConvocation;
    }

    public function addRefConvocation(Convocation $refConvocation): static
    {
        if (!$this->refConvocation->contains($refConvocation)) {
            $this->refConvocation->add($refConvocation);
            $refConvocation->setRefConvocation($this);
        }

        return $this;
    }

    public function removeRefConvocation(Convocation $refConvocation): static
    {
        if ($this->refConvocation->removeElement($refConvocation)) {
            // set the owning side to null (unless already changed)
            if ($refConvocation->getRefConvocation() === $this) {
                $refConvocation->setRefConvocation(null);
            }
        }

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

    public function setRefPromotion(Promotion $refPromotion): static
    {
        $this->refPromotion = $refPromotion;

        return $this;
    }
}
