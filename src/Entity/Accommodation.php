<?php

namespace App\Entity;

use App\Repository\AccommodationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccommodationRepository::class)]
class Accommodation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Location = null;

    #[ORM\Column]
    private ?int $AccomodationPrice = null;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'AccommodationService')]
    private Collection $IdService;

    /**
     * @var Collection<int, Cottage>
     */
    #[ORM\ManyToMany(targetEntity: Cottage::class, inversedBy: 'AccommodationCottage')]
    private Collection $IdCottage;

    public function __construct()
    {
        $this->IdService = new ArrayCollection();
        $this->IdCottage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): static
    {
        $this->Location = $Location;

        return $this;
    }

    public function getAccomodationPrice(): ?int
    {
        return $this->AccomodationPrice;
    }

    public function setAccomodationPrice(int $AccomodationPrice): static
    {
        $this->AccomodationPrice = $AccomodationPrice;

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getIdService(): Collection
    {
        return $this->IdService;
    }

    public function addIdService(Service $idService): static
    {
        if (!$this->IdService->contains($idService)) {
            $this->IdService->add($idService);
        }

        return $this;
    }

    public function removeIdService(Service $idService): static
    {
        $this->IdService->removeElement($idService);

        return $this;
    }

    /**
     * @return Collection<int, Cottage>
     */
    public function getIdCottage(): Collection
    {
        return $this->IdCottage;
    }

    public function addIdCottage(Cottage $idCottage): static
    {
        if (!$this->IdCottage->contains($idCottage)) {
            $this->IdCottage->add($idCottage);
        }

        return $this;
    }

    public function removeIdCottage(Cottage $idCottage): static
    {
        $this->IdCottage->removeElement($idCottage);

        return $this;
    }
}
