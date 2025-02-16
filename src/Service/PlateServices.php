<?php
namespace App\Service;

use App\Repository\PlateRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class PlateServices
{

    private EntityManagerInterface $entityManagerInterface;

    private PlateRepository $plateRepository;

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(PlateRepository $userRepository, EntityManagerInterface $entityManagerInterface,private EmailVerifier $emailVerifier,UserPasswordHasherInterface $passwordHasher)
    {
        $this->plateRepository = $userRepository;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->passwordHasher = $passwordHasher;
    }

    public function getAllPlates(): array
    {
        return $this->plateRepository->findAll();
    }

    public function getPlates(): array
    {
        $plates = $this->plateRepository->findAll();
        $plateJson = array();
        
        foreach ($plates as $plate) {
            $plateJson[] = [
                'name' => $plate->getName(),
                'value' => $plate->getValue(),
                'stock' => $plate->getStock(),
            ];
        }

        return $plateJson;
    }

    public function getPlatesForType($value): array
    {
        $plates = $this->plateRepository->findByTplate($value);
        $plateJson = array();
        
        foreach ($plates as $plate) {
            $plateJson[] = [
                'name' => $plate->getName(),
                'value' => $plate->getValue(),
                'stock' => $plate->getStock(),
            ];
        }

        return $plateJson;
    }


    

}
