<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserApiController extends AbstractController{
    #[Route('/api/user/api', name: 'app_api_user_api')]
    public function index(): Response
    {
        return $this->render('api/user_api/index.html.twig', [
            'controller_name' => 'Api/UserApiController',
        ]);
    }
}
