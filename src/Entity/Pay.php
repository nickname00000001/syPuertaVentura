<?php

namespace App\Entity;

use App\Repository\PayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\PaymentMethod;

#[ORM\Entity(repositoryClass: PayRepository::class)]
class Pay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $Total = null;

    #[ORM\ManyToOne(inversedBy: 'UserPay')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $IdUser = null;

    #[ORM\Column(type: 'string', enumType: PaymentMethod::class)]
    private ?PaymentMethod $typeP = null;

    /**
     * @var Collection<int, PaymentEntry>
     */
    #[ORM\ManyToMany(targetEntity: PaymentEntry::class, mappedBy: 'IdPay')]
    private Collection $PayId;

    public function __construct()
    {
        $this->PayId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->Total;
    }

    public function setTotal(float $Total): static
    {
        $this->Total = $Total;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->IdUser;
    }

    public function setIdUser(?User $IdUser): static
    {
        $this->IdUser = $IdUser;

        return $this;
    }
    public function getPaymentType(): ?PaymentMethod
    {
        return $this->typeP;
    }

    public function setPaymentType(PaymentMethod $typeP): static
    {
        $this->typeP = $typeP;

        return $this;
    }

    /**
     * @return Collection<int, PaymentEntry>
     */
    public function getPayId(): Collection
    {
        return $this->PayId;
    }

    public function addPayId(PaymentEntry $payId): static
    {
        if (!$this->PayId->contains($payId)) {
            $this->PayId->add($payId);
            $payId->addIdPay($this);
        }

        return $this;
    }

    public function removePayId(PaymentEntry $payId): static
    {
        if ($this->PayId->removeElement($payId)) {
            $payId->removeIdPay($this);
        }

        return $this;
    }
}
