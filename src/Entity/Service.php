<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\ServiceType;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $PhoneNumber = null;

    #[ORM\Column]
    private ?int $NumberPeople = null;

    #[ORM\Column(type: 'string', enumType: ServiceType::class)]
    private ?ServiceType $type = null;

    /**
     * @var Collection<int, UserService>
     */
    #[ORM\ManyToMany(targetEntity: UserService::class, mappedBy: 'serviceR')]
    private Collection $serviceR;

    #[ORM\ManyToOne(inversedBy: 'ServiceFood')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Food $ServiceAsociate = null;

    public function __construct()
    {
        $this->serviceR = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(int $PhoneNumber): static
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getNumberPeople(): ?int
    {
        return $this->NumberPeople;
    }

    public function setNumberPeople(int $NumberPeople): static
    {
        $this->NumberPeople = $NumberPeople;

        return $this;
    }

    public function getType(): ?ServiceType
    {
        return $this->type;
    }

    public function setType(ServiceType $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, UserService>
     */
    public function getServiceR(): Collection
    {
        return $this->serviceR;
    }

    public function addServiceR(UserService $serviceR): static
    {
        if (!$this->serviceR->contains($serviceR)) {
            $this->serviceR->add($serviceR);
            $serviceR->addServiceR($this);
        }

        return $this;
    }

    public function removeServiceR(UserService $serviceR): static
    {
        if ($this->serviceR->removeElement($serviceR)) {
            $serviceR->removeServiceR($this);
        }

        return $this;
    }

    public function getServiceAsociate(): ?Food
    {
        return $this->ServiceAsociate;
    }

    public function setServiceAsociate(?Food $ServiceAsociate): static
    {
        $this->ServiceAsociate = $ServiceAsociate;

        return $this;
    }
}
