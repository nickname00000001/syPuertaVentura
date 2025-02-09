<?php

namespace App\Controller\Web;

use App\Entity\User;
use App\Form\UserFormType;
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

    #[Route('/showform', name: 'app_web_form')]
    public function indexForm(): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        return $this->render('web/use_web/index.html.twig', [
            'controller_name' => 'Web/UseWebController',
            'form' => $form->createView(),
        ]);
    }
}
