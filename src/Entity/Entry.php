<?php

namespace App\Entity;

use App\Repository\EntryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntryRepository::class)]
class Entry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEntry = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $Age = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $Tlf = null;

    /**
     * @var Collection<int, PaymentEntry>
     */
    #[ORM\ManyToMany(targetEntity: PaymentEntry::class, mappedBy: 'IdEntry')]
    private Collection $IdPay;

    /**
     * @var Collection<int, ServicePerEntry>
     */
    #[ORM\ManyToMany(targetEntity: ServicePerEntry::class, mappedBy: 'Entry')]
    private Collection $IdEntry;

    /**
     * @var Collection<int, EntryAttraction>
     */
    #[ORM\ManyToMany(targetEntity: EntryAttraction::class, mappedBy: 'Entry')]
    private Collection $EntryA;

    public function __construct()
    {
        $this->IdPay = new ArrayCollection();
        $this->IdEntry = new ArrayCollection();
        $this->EntryA = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntry(): ?\DateTimeInterface
    {
        return $this->dateEntry;
    }

    public function setDateEntry(\DateTimeInterface $dateEntry): static
    {
        $this->dateEntry = $dateEntry;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): static
    {
        $this->Age = $Age;

        return $this;
    }

    public function getTlf(): ?int
    {
        return $this->Tlf;
    }

    public function setTlf(int $Tlf): static
    {
        $this->Tlf = $Tlf;

        return $this;
    }

    /**
     * @return Collection<int, PaymentEntry>
     */
    public function getIdPay(): Collection
    {
        return $this->IdPay;
    }

    public function addIdPay(PaymentEntry $idPay): static
    {
        if (!$this->IdPay->contains($idPay)) {
            $this->IdPay->add($idPay);
            $idPay->addIdEntry($this);
        }

        return $this;
    }

    public function removeIdPay(PaymentEntry $idPay): static
    {
        if ($this->IdPay->removeElement($idPay)) {
            $idPay->removeIdEntry($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ServicePerEntry>
     */
    public function getIdEntry(): Collection
    {
        return $this->IdEntry;
    }

    public function addIdEntry(ServicePerEntry $idEntry): static
    {
        if (!$this->IdEntry->contains($idEntry)) {
            $this->IdEntry->add($idEntry);
            $idEntry->addEntry($this);
        }

        return $this;
    }

    public function removeIdEntry(ServicePerEntry $idEntry): static
    {
        if ($this->IdEntry->removeElement($idEntry)) {
            $idEntry->removeEntry($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, EntryAttraction>
     */
    public function getEntryA(): Collection
    {
        return $this->EntryA;
    }

    public function addEntryA(EntryAttraction $entryA): static
    {
        if (!$this->EntryA->contains($entryA)) {
            $this->EntryA->add($entryA);
            $entryA->addEntry($this);
        }

        return $this;
    }

    public function removeEntryA(EntryAttraction $entryA): static
    {
        if ($this->EntryA->removeElement($entryA)) {
            $entryA->removeEntry($this);
        }

        return $this;
    }
}
