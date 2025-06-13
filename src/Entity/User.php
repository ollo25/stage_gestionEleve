<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use function Sodium\randombytes_uniform;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    /**
     * @var Collection<int, PotentielEleve>
     */
    #[ORM\OneToMany(targetEntity: PotentielEleve::class, mappedBy: 'refResponsable')]
    private Collection $potentielEleves;

    /**
     * @var Collection<int, Convocation>
     */
    #[ORM\OneToMany(targetEntity: Convocation::class, mappedBy: 'refResponsable')]
    private Collection $convocations;

    public function __construct()
    {
        $this->potentielEleves = new ArrayCollection();
        $this->convocations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    /**
     * @return Collection<int, PotentielEleve>
     */
    public function getPotentielEleves(): Collection
    {
        return $this->potentielEleves;
    }

    public function addPotentielElefe(PotentielEleve $potentielElefe): static
    {
        if (!$this->potentielEleves->contains($potentielElefe)) {
            $this->potentielEleves->add($potentielElefe);
            $potentielElefe->setRefResponsable($this);
        }

        return $this;
    }

    public function removePotentielElefe(PotentielEleve $potentielElefe): static
    {
        if ($this->potentielEleves->removeElement($potentielElefe)) {
            // set the owning side to null (unless already changed)
            if ($potentielElefe->getRefResponsable() === $this) {
                $potentielElefe->setRefResponsable(null);
            }
        }

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
            $convocation->setRefResponsable($this);
        }

        return $this;
    }

    public function removeConvocation(Convocation $convocation): static
    {
        if ($this->convocations->removeElement($convocation)) {
            // set the owning side to null (unless already changed)
            if ($convocation->getRefResponsable() === $this) {
                $convocation->setRefResponsable(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->nom." ".$this->Prenom;// TODO: Implement __toString() method.
    }
}
