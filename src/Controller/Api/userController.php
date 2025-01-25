<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class Api/userController extends AbstractController{
    #[Route('/api/user', name: 'app_api_user')]
    public function index(): Response
    {
        return $this->render('api/user/index.html.twig', [
            'controller_name' => 'Api/userController',
        ]);
    }
}
