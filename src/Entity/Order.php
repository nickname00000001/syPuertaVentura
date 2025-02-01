<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\StatusOrder;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Food $FoodOrder = null;

    #[ORM\Column(type: 'string', enumType: StatusOrder::class)]
    private ?StatusOrder $status = null;

    /**
     * @var Collection<int, PlatesOrder>
     */
    #[ORM\OneToMany(targetEntity: PlatesOrder::class, mappedBy: 'NroOrder')]
    private Collection $PlatesPerOrder;

    public function __construct()
    {
        $this->PlatesPerOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFoodOrder(): ?Food
    {
        return $this->FoodOrder;
    }

    public function setFoodOrder(?Food $FoodOrder): static
    {
        $this->FoodOrder = $FoodOrder;

        return $this;
    }

    public function getStatus(): ?StatusOrder
    {
        return $this->status;
    }

    public function setStatus(StatusOrder $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, PlatesOrder>
     */
    public function getPlatesPerOrder(): Collection
    {
        return $this->PlatesPerOrder;
    }

    public function addPlatesPerOrder(PlatesOrder $platesPerOrder): static
    {
        if (!$this->PlatesPerOrder->contains($platesPerOrder)) {
            $this->PlatesPerOrder->add($platesPerOrder);
            $platesPerOrder->setNroOrder($this);
        }

        return $this;
    }

    public function removePlatesPerOrder(PlatesOrder $platesPerOrder): static
    {
        if ($this->PlatesPerOrder->removeElement($platesPerOrder)) {
            // set the owning side to null (unless already changed)
            if ($platesPerOrder->getNroOrder() === $this) {
                $platesPerOrder->setNroOrder(null);
            }
        }

        return $this;
    }

}
