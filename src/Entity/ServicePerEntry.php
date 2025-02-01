<?php

namespace App\Entity;

use App\Repository\ServicePerEntryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicePerEntryRepository::class)]
class ServicePerEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'IdService')]
    private Collection $Service;

    /**
     * @var Collection<int, Entry>
     */
    #[ORM\ManyToMany(targetEntity: Entry::class, inversedBy: 'IdEntry')]
    private Collection $Entry;

    public function __construct()
    {
        $this->Service = new ArrayCollection();
        $this->Entry = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getService(): Collection
    {
        return $this->Service;
    }

    public function addService(Service $service): static
    {
        if (!$this->Service->contains($service)) {
            $this->Service->add($service);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        $this->Service->removeElement($service);

        return $this;
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
}
