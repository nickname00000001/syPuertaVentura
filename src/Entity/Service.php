<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\ServiceType;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $PhoneNumber = null;

    #[ORM\Column]
    private ?int $NumberPeople = null;

    #[ORM\Column(type: 'string', enumType: ServiceType::class)]
    private ?ServiceType $type = null;

    /**
     * @var Collection<int, UserService>
     */
    #[ORM\ManyToMany(targetEntity: UserService::class, mappedBy: 'serviceR')]
    private Collection $serviceR;

    #[ORM\ManyToOne(inversedBy: 'ServiceFood')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Food $ServiceAsociate = null;

    /**
     * @var Collection<int, ServicePerEntry>
     */
    #[ORM\ManyToMany(targetEntity: ServicePerEntry::class, mappedBy: 'Service')]
    private Collection $IdService;

    /**
     * @var Collection<int, Accommodation>
     */
    #[ORM\ManyToMany(targetEntity: Accommodation::class, mappedBy: 'IdService')]
    private Collection $AccommodationService;

    public function __construct()
    {
        $this->serviceR = new ArrayCollection();
        $this->IdService = new ArrayCollection();
        $this->AccommodationService = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(int $PhoneNumber): static
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getNumberPeople(): ?int
    {
        return $this->NumberPeople;
    }

    public function setNumberPeople(int $NumberPeople): static
    {
        $this->NumberPeople = $NumberPeople;

        return $this;
    }

    public function getType(): ?ServiceType
    {
        return $this->type;
    }

    public function setType(ServiceType $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, UserService>
     */
    public function getServiceR(): Collection
    {
        return $this->serviceR;
    }

    public function addServiceR(UserService $serviceR): static
    {
        if (!$this->serviceR->contains($serviceR)) {
            $this->serviceR->add($serviceR);
            $serviceR->addServiceR($this);
        }

        return $this;
    }

    public function removeServiceR(UserService $serviceR): static
    {
        if ($this->serviceR->removeElement($serviceR)) {
            $serviceR->removeServiceR($this);
        }

        return $this;
    }

    public function getServiceAsociate(): ?Food
    {
        return $this->ServiceAsociate;
    }

    public function setServiceAsociate(?Food $ServiceAsociate): static
    {
        $this->ServiceAsociate = $ServiceAsociate;

        return $this;
    }

    /**
     * @return Collection<int, ServicePerEntry>
     */
    public function getIdService(): Collection
    {
        return $this->IdService;
    }

    public function addIdService(ServicePerEntry $idService): static
    {
        if (!$this->IdService->contains($idService)) {
            $this->IdService->add($idService);
            $idService->addService($this);
        }

        return $this;
    }

    public function removeIdService(ServicePerEntry $idService): static
    {
        if ($this->IdService->removeElement($idService)) {
            $idService->removeService($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Accommodation>
     */
    public function getAccommodationService(): Collection
    {
        return $this->AccommodationService;
    }

    public function addAccommodationService(Accommodation $accommodationService): static
    {
        if (!$this->AccommodationService->contains($accommodationService)) {
            $this->AccommodationService->add($accommodationService);
            $accommodationService->addIdService($this);
        }

        return $this;
    }

    public function removeAccommodationService(Accommodation $accommodationService): static
    {
        if ($this->AccommodationService->removeElement($accommodationService)) {
            $accommodationService->removeIdService($this);
        }

        return $this;
    }
}
