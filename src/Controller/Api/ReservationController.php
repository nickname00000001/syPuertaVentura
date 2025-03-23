<?php

namespace App\Controller\Api;

use App\Service\PayServices;
use App\Service\PlateServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReservationController extends AbstractController
{

    private PlateServices $plateService;

    private PayServices $payService;


    public function __construct(PlateServices $plateService, PayServices $payService)
    {
        $this->plateService = $plateService;
        $this->payService = $payService;
    }

    #[Route('/api/reservation', name: 'app_api_reservation')]
    public function index(): JsonResponse
    {
        return $this->render('api/reservation/index.html.twig', [
            'controller_name' => 'Api/ReservationController',
        ]);
    }


    //Ruta para obtener los platos:

    #[Route('/api/plates', name: 'plates_get', methods: ['GET'])]
    public function listPlates(): Response
    {
        $plates = $this->plateService->getPlates();

        return $this->json($plates, Response::HTTP_OK);
    }


    #[Route('/api/tplates', name: 'platetype_get', methods: ['GET'])]
    public function listPlatesType(Request $request): JsonResponse
    {
        $type = $request->query->get('type');
        $plates = $this->plateService->getPlatesForType($type);

        return $this->json($plates, Response::HTTP_OK);
    }

    //------------------------------add pay   --------------------------------
    #[Route('/api/pay', name: 'pay_set', methods: ['POST'])]
    public function addpay(Request $request): JsonResponse
    {
        $session = $request->getSession();
        $platos = $session->get('platos', []);


        //si no wxiste platos ni alojamientos se procedera al pago

        if (empty($platos)) {
            $this->payService->addPaymentEntry($request);
            return $this->json("Pago por entrada añadido con exito", Response::HTTP_OK);
        }



        //crear un servicio primero
        //EL servicio asociarlo a las entradas
        //crear una comida en el caso de que hay platos
        //crear una orden y asociarla a la cimida 
        //a la orden asociarle los platos
        

        //si hay platos se creara la comida sino se creara el alojamiento
        


        foreach ($platos as $platoId => $cantidad) {
            // Aquí puedes realizar las acciones necesarias con cada plato
            
            // Por ejemplo, crear una orden con los platos

            




        }

        return $this->json($platos, Response::HTTP_OK);
    }







    #[Route('/api/ordersession', name: 'oder_add', methods: ['POST'])]
    public function orderplates(Request $request): JsonResponse
    {

        $session = $request->getSession();
        $platos = $session->get('platos', []);
        $data = json_decode($request->getContent(), true);

        if (!isset($data['id']) || !isset($data['cantidad'])) {
            return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
        }

        $platoId = $data['id'];
        $cantidad = $data['cantidad'];

        // Actualizar o agregar el plato en la variable de sesión
        $platos[$platoId] = $cantidad;

        // Guardar los datos actualizados en la sesión
        $session->set('platos', $platos);

        return $this->json(['platos' => $platos, 'success' => 'Plato actualizado con éxito'], Response::HTTP_OK);
    }
}
