<?php

namespace App\Entity;

use App\Repository\AttractionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttractionRepository::class)]
class Attraction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $Ability = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $OpenTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $CloseTime = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $AgeMin = null;

    #[ORM\Column]
    private ?float $Cost = null;

    /**
     * @var Collection<int, EntryAttraction>
     */
    #[ORM\ManyToMany(targetEntity: EntryAttraction::class, mappedBy: 'Attraction')]
    private Collection $AttractionEntry;

    public function __construct()
    {
        $this->AttractionEntry = new ArrayCollection();
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

    public function getAbility(): ?int
    {
        return $this->Ability;
    }

    public function setAbility(int $Ability): static
    {
        $this->Ability = $Ability;

        return $this;
    }

    public function getOpenTime(): ?\DateTimeInterface
    {
        return $this->OpenTime;
    }

    public function setOpenTime(\DateTimeInterface $OpenTime): static
    {
        $this->OpenTime = $OpenTime;

        return $this;
    }

    public function getCloseTime(): ?\DateTimeInterface
    {
        return $this->CloseTime;
    }

    public function setCloseTime(\DateTimeInterface $CloseTime): static
    {
        $this->CloseTime = $CloseTime;

        return $this;
    }

    public function getAgeMin(): ?int
    {
        return $this->AgeMin;
    }

    public function setAgeMin(int $AgeMin): static
    {
        $this->AgeMin = $AgeMin;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->Cost;
    }

    public function setCost(float $Cost): static
    {
        $this->Cost = $Cost;

        return $this;
    }

    /**
     * @return Collection<int, EntryAttraction>
     */
    public function getAttractionEntry(): Collection
    {
        return $this->AttractionEntry;
    }

    public function addAttractionEntry(EntryAttraction $attractionEntry): static
    {
        if (!$this->AttractionEntry->contains($attractionEntry)) {
            $this->AttractionEntry->add($attractionEntry);
            $attractionEntry->addAttraction($this);
        }

        return $this;
    }

    public function removeAttractionEntry(EntryAttraction $attractionEntry): static
    {
        if ($this->AttractionEntry->removeElement($attractionEntry)) {
            $attractionEntry->removeAttraction($this);
        }

        return $this;
    }
}
