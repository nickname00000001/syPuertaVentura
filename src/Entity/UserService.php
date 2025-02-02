<?php

namespace App\Entity;

use App\Repository\UserServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\StatusReserve;

#[ORM\Entity(repositoryClass: UserServiceRepository::class)]
class UserService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'userSer')]
    private Collection $Usuario;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'serviceR')]
    private Collection $serviceR;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $ReservationDate = null;

    #[ORM\Column(type: 'string', enumType: StatusReserve::class)]
    private ?StatusReserve $state = null;

    public function __construct()
    {
        $this->Usuario = new ArrayCollection();
        $this->serviceR = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsuario(): Collection
    {
        return $this->Usuario;
    }

    public function addUsuario(User $usuario): static
    {
        if (!$this->Usuario->contains($usuario)) {
            $this->Usuario->add($usuario);
        }

        return $this;
    }

    public function removeUsuario(User $usuario): static
    {
        $this->Usuario->removeElement($usuario);

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServiceR(): Collection
    {
        return $this->serviceR;
    }

    public function addServiceR(Service $serviceR): static
    {
        if (!$this->serviceR->contains($serviceR)) {
            $this->serviceR->add($serviceR);
        }

        return $this;
    }

    public function removeServiceR(Service $serviceR): static
    {
        $this->serviceR->removeElement($serviceR);

        return $this;
    }

    public function getReservationDate(): ?\DateTimeInterface
    {
        return $this->ReservationDate;
    }

    public function setReservationDate(\DateTimeInterface $ReservationDate): static
    {
        $this->ReservationDate = $ReservationDate;

        return $this;
    }

    public function getState(): ?StatusReserve
    {
        return $this->state;
    }

    public function setState(StatusReserve $state): self
    {
        $this->state = $state;

        return $this;
    }
}
