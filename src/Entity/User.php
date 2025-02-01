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
     * @var Collection<int, UserService>
     */
    #[ORM\ManyToMany(targetEntity: UserService::class, mappedBy: 'Usuario')]
    private Collection $userSer;

    /**
     * @var Collection<int, Pay>
     */
    #[ORM\OneToMany(targetEntity: Pay::class, mappedBy: 'IdUser', orphanRemoval: true)]
    private Collection $UserPay;

    public function __construct()
    {
        $this->userSer = new ArrayCollection();
        $this->UserPay = new ArrayCollection();
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
     *
     * @return list<string>
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
     * @return Collection<int, UserService>
     */
    public function getUserSer(): Collection
    {
        return $this->userSer;
    }

    public function addUserSer(UserService $userSer): static
    {
        if (!$this->userSer->contains($userSer)) {
            $this->userSer->add($userSer);
            $userSer->addUsuario($this);
        }

        return $this;
    }

    public function removeUserSer(UserService $userSer): static
    {
        if ($this->userSer->removeElement($userSer)) {
            $userSer->removeUsuario($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Pay>
     */
    public function getUserPay(): Collection
    {
        return $this->UserPay;
    }

    public function addUserPay(Pay $userPay): static
    {
        if (!$this->UserPay->contains($userPay)) {
            $this->UserPay->add($userPay);
            $userPay->setIdUser($this);
        }

        return $this;
    }

    public function removeUserPay(Pay $userPay): static
    {
        if ($this->UserPay->removeElement($userPay)) {
            // set the owning side to null (unless already changed)
            if ($userPay->getIdUser() === $this) {
                $userPay->setIdUser(null);
            }
        }

        return $this;
    }
}
