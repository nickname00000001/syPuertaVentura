<?php

namespace App\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

//Esto es para no tener que poner /api en todas las rutas ya que se entiende que todas van a tener /api
#[Route('/api', name: 'app_api_user')]

final class UserController extends AbstractController
{

    #[Route('/userRegister', name: 'user_register')]

    public function UserRegister(EntityManagerInterface $entityManager, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {

        $body = $request->getContent();
        $data = json_decode($body, true);

        $user = new User();
        $user->setEmail($data['email']);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data['password'],
        );
        $user->setPassword($hashedPassword);


        $entityManager->persist($user);
        $entityManager->flush();


        return $this->json("User created", Response::HTTP_CREATED);

        // esto es para renderizar una vista:
        /* return $this->render('api/user/index.html.twig', [
            'controller_name' => 'Api/UserController',
        ]); */
    }


    #[Route('/get', name: 'user_get')]
    public function userGet(UserRepository $userRep): Response
    {
        $users = $userRep->findAll();
        $userJson = array();
        
        foreach ($users as $user) {
            $userJson[] = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'username' => $user->getUsername(),
            ];
        }

        return $this->json($userJson, Response::HTTP_OK);
    }

    #[Route('/delete', name: 'user_delete')]
    public function userDelete(Request $request, UserRepository $userRep, EntityManager $em): Response
    {

        $body = $request->getContent();
        $data = json_decode($body, true);



        $user = $userRep->find($data['id']);
        if (!$user) {
            throw new AccessDeniedHttpException('User not found');
        }
        $em->remove($user);
        $em->flush();


        return $this->json("Usuario Borrado con exito", Response::HTTP_OK);
    }
}
