<?php

namespace App\Entity;

use App\Enum\TypePlate;
use App\Repository\PlateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlateRepository::class)]
class Plate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?int $Value = null;

    #[ORM\Column]
    private ?int $Stock = null;

    #[ORM\Column(type: 'string', enumType: TypePlate::class)]
    private ?TypePlate $tplate = null;

    /**
     * @var Collection<int, PlatesOrder>
     */
    #[ORM\ManyToMany(targetEntity: PlatesOrder::class, mappedBy: 'plate')]
    private Collection $NroOrder;

    public function __construct()
    {
        $this->NroOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->Value;
    }

    public function setValue(int $Value): static
    {
        $this->Value = $Value;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->Stock;
    }

    public function setStock(int $Stock): static
    {
        $this->Stock = $Stock;

        return $this;
    }

    /**
     * @return Collection<int, PlatesOrder>
     */
    public function getNroOrder(): Collection
    {
        return $this->NroOrder;
    }

    public function addNroOrder(PlatesOrder $nroOrder): static
    {
        if (!$this->NroOrder->contains($nroOrder)) {
            $this->NroOrder->add($nroOrder);
            $nroOrder->addPlate($this);
        }

        return $this;
    }

    public function removeNroOrder(PlatesOrder $nroOrder): static
    {
        if ($this->NroOrder->removeElement($nroOrder)) {
            $nroOrder->removePlate($this);
        }

        return $this;
    }

    public function getTplate(): ?TypePlate
    {
        return $this->tplate;
    }

    public function setTplate(TypePlate $tplate): static
    {
        $this->tplate = $tplate;

        return $this;
    }
}
