<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ReservationWebController extends AbstractController
{

    public function __construct(
        private HttpClientInterface $client,
    ) {}


    #[Route('/web/reservation/web', name: 'app_web_reservation_web')]
    public function index(): Response
    {
        return $this->render('web/reservation_web/index.html.twig', [
            'controller_name' => 'Web/ReservationWebController',
        ]);
    }

    /*     #[Route('/web/use/web', name: 'app_web_use_web')]
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

    intento de redireccionar::
 */
    #[Route('/web/plates', name: 'web_reservation_plates')]
    public function renderPlates(Request $request): Response
    {

        // Generar una URL absoluta para el endpoint de la API
        $url = $this->generateUrl('plates_get', [], UrlGeneratorInterface::ABSOLUTE_URL);

        // Realizar la solicitud a la API
        $response = $this->client->request('GET', $url);

        // Verificar si la solicitud fue exitosa
        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Error al obtener los datos de la API');
        }

        // Obtener el contenido de la respuesta
        $data = $response->toArray();

        // Pasar los datos a la plantilla
        return $this->render('web/reservation_web/plates.html.twig', [
            'plates' => $data,
        ]);
    }
}
