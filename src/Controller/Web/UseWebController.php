<?php

namespace App\Controller\Web;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class UseWebController extends AbstractController{


    private HttpClientInterface $client;
    
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    
/* 
    #[Route('/web/use/web', name: 'app_web_use_web')]
    public function listUsers(): Response
    {
        // Realizar la solicitud a la API
        $response = $this->client->request('GET', 'https://example.com/api/get');

        // Obtener el contenido de la respuesta
        $data = $response->toArray();

        // Pasar los datos a la plantilla
        return $this->render('web/use_web/index.html.twig', [
            'api_data' => $data,
        ]);
    }

 */
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

    #[Route('/register', name: 'user_register_form')]
    public function userRegister(): Response
    {

        // Realizar la solicitud a la API
        /* $response = $this->client->request('POST', 'https://example.com/api/get',[
            'body' =>'email',
        ]); */
        $response = $this->client->request('POST', $this->generateUrl('app_register'), [
            'body' => 'email',
        ]);


        // Obtener el contenido de la respuesta
        $data = $response->toArray();

/* 
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_web_main');
        } */

        
        // Pasar los datos a la plantilla
        $formu = $response->form;
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $formu,
            'api_data' => $data
        ]);
    }

}
