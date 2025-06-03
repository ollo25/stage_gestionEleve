<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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

    /**
     * @var Collection<int, PotentielEleve>
     */
    #[ORM\OneToMany(targetEntity: PotentielEleve::class, mappedBy: 'refResponsable')]
    private Collection $refPotentielEleve;

    /**
     * @var Collection<int, Convocation>
     */
    #[ORM\OneToMany(targetEntity: Convocation::class, mappedBy: 'refResponsable')]
    private Collection $refConvocation;

    public function __construct()
    {
        $this->refPotentielEleve = new ArrayCollection();
        $this->refConvocation = new ArrayCollection();
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

    /**
     * @return Collection<int, PotentielEleve>
     */
    public function getRefPotentielEleve(): Collection
    {
        return $this->refPotentielEleve;
    }

    public function addRefPotentielEleve(PotentielEleve $refPotentielEleve): static
    {
        if (!$this->refPotentielEleve->contains($refPotentielEleve)) {
            $this->refPotentielEleve->add($refPotentielEleve);
            $refPotentielEleve->setRefResponsable($this);
        }

        return $this;
    }

    public function removeRefPotentielEleve(PotentielEleve $refPotentielEleve): static
    {
        if ($this->refPotentielEleve->removeElement($refPotentielEleve)) {
            // set the owning side to null (unless already changed)
            if ($refPotentielEleve->getRefResponsable() === $this) {
                $refPotentielEleve->setRefResponsable(null);
            }
        }

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
            $refConvocation->setRefResponsable($this);
        }

        return $this;
    }

    public function removeRefConvocation(Convocation $refConvocation): static
    {
        if ($this->refConvocation->removeElement($refConvocation)) {
            // set the owning side to null (unless already changed)
            if ($refConvocation->getRefResponsable() === $this) {
                $refConvocation->setRefResponsable(null);
            }
        }

        return $this;
    }
}
