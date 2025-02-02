<?php

namespace App\Entity;

use App\Repository\PaymentEntryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\PaymentStatus;

#[ORM\Entity(repositoryClass: PaymentEntryRepository::class)]
class PaymentEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Entry>
     */
    #[ORM\ManyToMany(targetEntity: Entry::class, inversedBy: 'IdPay')]
    private Collection $IdEntry;

    #[ORM\Column(type: 'string', enumType: PaymentStatus::class)]
    private ?PaymentStatus $statusP = null;


    /**
     * @var Collection<int, Pay>
     */
    #[ORM\ManyToMany(targetEntity: Pay::class, inversedBy: 'PayId')]
    private Collection $IdPay;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DatePayment = null;

    public function __construct()
    {
        $this->IdEntry = new ArrayCollection();
        $this->IdPay = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Entry>
     */
    public function getIdEntry(): Collection
    {
        return $this->IdEntry;
    }

    public function addIdEntry(Entry $idEntry): static
    {
        if (!$this->IdEntry->contains($idEntry)) {
            $this->IdEntry->add($idEntry);
        }

        return $this;
    }

    public function removeIdEntry(Entry $idEntry): static
    {
        $this->IdEntry->removeElement($idEntry);

        return $this;
    }

    /**
     * @return Collection<int, Pay>
     */
    public function getIdPay(): Collection
    {
        return $this->IdPay;
    }

    public function addIdPay(Pay $idPay): static
    {
        if (!$this->IdPay->contains($idPay)) {
            $this->IdPay->add($idPay);
        }

        return $this;
    }

    public function removeIdPay(Pay $idPay): static
    {
        $this->IdPay->removeElement($idPay);

        return $this;
    }

    public function getDatePayment(): ?\DateTimeInterface
    {
        return $this->DatePayment;
    }

    public function setDatePayment(\DateTimeInterface $DatePayment): static
    {
        $this->DatePayment = $DatePayment;

        return $this;
    }

    public function getStatusP(): ?PaymentStatus
    {
        return $this->statusP;
    }

    public function setStatusP(PaymentStatus $statusP): static
    {
        $this->statusP = $statusP;

        return $this;
    }
}
