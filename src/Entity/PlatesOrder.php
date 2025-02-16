<?php

namespace App\Entity;

use App\Repository\PlatesOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\TypePlate;

#[ORM\Entity(repositoryClass: PlatesOrderRepository::class)]
class PlatesOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Plate>
     */
    #[ORM\ManyToMany(targetEntity: Plate::class, inversedBy: 'NroOrder')]
    private Collection $plate;

    #[ORM\ManyToOne(inversedBy: 'PlatesPerOrder')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $NroOrder = null;

    #[ORM\Column]
    private ?int $NroPlates = null;

  

    public function __construct()
    {
        $this->plate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Plate>
     */
    public function getPlate(): Collection
    {
        return $this->plate;
    }

    public function addPlate(Plate $plate): static
    {
        if (!$this->plate->contains($plate)) {
            $this->plate->add($plate);
        }

        return $this;
    }

    public function removePlate(Plate $plate): static
    {
        $this->plate->removeElement($plate);

        return $this;
    }

    public function getNroOrder(): ?Order
    {
        return $this->NroOrder;
    }

    public function setNroOrder(?Order $NroOrder): static
    {
        $this->NroOrder = $NroOrder;

        return $this;
    }

    public function getNroPlates(): ?int
    {
        return $this->NroPlates;
    }

    public function setNroPlates(int $NroPlates): static
    {
        $this->NroPlates = $NroPlates;

        return $this;
    }
    
}
