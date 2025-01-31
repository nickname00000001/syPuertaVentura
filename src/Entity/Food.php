<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodRepository::class)]
class Food
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $Payment = null;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'ServiceAsociate')]
    private Collection $ServiceFood;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'FoodOrder', orphanRemoval: true)]
    private Collection $orderFood;

    public function __construct()
    {
        $this->ServiceFood = new ArrayCollection();
        $this->orderFood = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayment(): ?float
    {
        return $this->Payment;
    }

    public function setPayment(float $Payment): static
    {
        $this->Payment = $Payment;

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServiceFood(): Collection
    {
        return $this->ServiceFood;
    }

    public function addServiceFood(Service $serviceFood): static
    {
        if (!$this->ServiceFood->contains($serviceFood)) {
            $this->ServiceFood->add($serviceFood);
            $serviceFood->setServiceAsociate($this);
        }

        return $this;
    }

    public function removeServiceFood(Service $serviceFood): static
    {
        if ($this->ServiceFood->removeElement($serviceFood)) {
            // set the owning side to null (unless already changed)
            if ($serviceFood->getServiceAsociate() === $this) {
                $serviceFood->setServiceAsociate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrderFood(): Collection
    {
        return $this->orderFood;
    }

    public function addOrderFood(Order $orderFood): static
    {
        if (!$this->orderFood->contains($orderFood)) {
            $this->orderFood->add($orderFood);
            $orderFood->setFoodOrder($this);
        }

        return $this;
    }

    public function removeOrderFood(Order $orderFood): static
    {
        if ($this->orderFood->removeElement($orderFood)) {
            // set the owning side to null (unless already changed)
            if ($orderFood->getFoodOrder() === $this) {
                $orderFood->setFoodOrder(null);
            }
        }

        return $this;
    }
}
