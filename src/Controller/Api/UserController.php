<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController{
    #[Route('/api/user', name: 'app_api_user')]
    public function index(): Response
    {
        return $this->json(['message' => 'Welcome to your new controller!'
        ]);

        // esto es para renderizar una vista:
        /* return $this->render('api/user/index.html.twig', [
            'controller_name' => 'Api/UserController',
        ]); */
    }
}
