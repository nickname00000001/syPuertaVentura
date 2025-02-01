<?php

namespace App\Entity;

use App\Repository\EntryAttractionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntryAttractionRepository::class)]
class EntryAttraction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Entry>
     */
    #[ORM\ManyToMany(targetEntity: Entry::class, inversedBy: 'EntryA')]
    private Collection $Entry;

    /**
     * @var Collection<int, Attraction>
     */
    #[ORM\ManyToMany(targetEntity: Attraction::class, inversedBy: 'AttractionEntry')]
    private Collection $Attraction;

    public function __construct()
    {
        $this->Entry = new ArrayCollection();
        $this->Attraction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Entry>
     */
    public function getEntry(): Collection
    {
        return $this->Entry;
    }

    public function addEntry(Entry $entry): static
    {
        if (!$this->Entry->contains($entry)) {
            $this->Entry->add($entry);
        }

        return $this;
    }

    public function removeEntry(Entry $entry): static
    {
        $this->Entry->removeElement($entry);

        return $this;
    }

    /**
     * @return Collection<int, Attraction>
     */
    public function getAttraction(): Collection
    {
        return $this->Attraction;
    }

    public function addAttraction(Attraction $attraction): static
    {
        if (!$this->Attraction->contains($attraction)) {
            $this->Attraction->add($attraction);
        }

        return $this;
    }

    public function removeAttraction(Attraction $attraction): static
    {
        $this->Attraction->removeElement($attraction);

        return $this;
    }
}
