<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
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
}
