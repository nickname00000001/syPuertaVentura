<?php

namespace App\Entity;

use App\Repository\CottageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CottageRepository::class)]
class Cottage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $Ability = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Details = null;

    /**
     * @var Collection<int, Accommodation>
     */
    #[ORM\ManyToMany(targetEntity: Accommodation::class, mappedBy: 'IdCottage')]
    private Collection $AccommodationCottage;

    public function __construct()
    {
        $this->AccommodationCottage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbility(): ?int
    {
        return $this->Ability;
    }

    public function setAbility(int $Ability): static
    {
        $this->Ability = $Ability;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->Details;
    }

    public function setDetails(string $Details): static
    {
        $this->Details = $Details;

        return $this;
    }

    /**
     * @return Collection<int, Accommodation>
     */
    public function getAccommodationCottage(): Collection
    {
        return $this->AccommodationCottage;
    }

    public function addAccommodationCottage(Accommodation $accommodationCottage): static
    {
        if (!$this->AccommodationCottage->contains($accommodationCottage)) {
            $this->AccommodationCottage->add($accommodationCottage);
            $accommodationCottage->addIdCottage($this);
        }

        return $this;
    }

    public function removeAccommodationCottage(Accommodation $accommodationCottage): static
    {
        if ($this->AccommodationCottage->removeElement($accommodationCottage)) {
            $accommodationCottage->removeIdCottage($this);
        }

        return $this;
    }
}
