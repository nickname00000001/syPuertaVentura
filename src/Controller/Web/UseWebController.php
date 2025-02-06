<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UseWebController extends AbstractController{
    #[Route('/web/use/web', name: 'app_web_use_web')]
    public function listUsers(): Response
    {
        return $this->render('web/use_web/index.html.twig', [
            'api_endpoint' => '/api/get',
        ]);
    }
}
