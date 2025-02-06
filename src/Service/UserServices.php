<?php
namespace App\Service;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;

class UserServices
{

    private EntityManagerInterface $entityManagerInterface;

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManagerInterface)
    {
        $this->userRepository = $userRepository;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function getUsers(): array
    {
        $users = $this->userRepository->findAll();
        $userJson = array();
        
        foreach ($users as $user) {
            $userJson[] = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'username' => $user->getUsername(),
            ];
        }

        return $userJson;
    }


    ////

    public function registerUsers( Request $request)
    {

        $passwordHasher = new UserPasswordHasherInterface();
        $body = $request->getContent();
        $data = json_decode($body, true);

        $user = new User();
        $user->setEmail($data['email']);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data['password'],
        );
        $user->setPassword($hashedPassword);


        $this->entityManagerInterface->persist($user);
        $this->entityManagerInterface->flush();
        
    }

    public function userDelete(Request $request): Response
    {

        $body = $request->getContent();
        $data = json_decode($body, true);



        $user = $this->userRepository->find($data['id']);
        if (!$user) {
            throw new AccessDeniedHttpException('User not found');
        }
        $this->entityManagerInterface->remove($user);
        $this->entityManagerInterface->flush();


        return new JsonResponse("Usuario Borrado con exito", Response::HTTP_OK);
    }

}
