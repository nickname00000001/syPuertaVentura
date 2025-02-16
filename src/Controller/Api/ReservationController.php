<?php

namespace App\Controller\Api;

use App\Service\PlateServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReservationController extends AbstractController{

    private PlateServices $plateService;


    public function __construct(PlateServices $plateService)
    {
        $this->plateService = $plateService;
    }

    #[Route('/api/reservation', name: 'app_api_reservation')]
    public function index(): JsonResponse
    {
        return $this->render('api/reservation/index.html.twig', [
            'controller_name' => 'Api/ReservationController',
        ]);
    }


    //Ruta para obtener los platos:

    #[Route('/api/plates',name: 'plates_get',methods:['GET'])]
    public function listPlates(): Response
    {
        $plates = $this->plateService->getPlates();

        return $this->json($plates, Response::HTTP_OK);
    }


    #[Route('/api/tplates',name: 'platetype_get',methods:['GET'])]
    public function listPlatesType(Request $request): JsonResponse
    {
        $type = $request->query->get('type');
        $plates = $this->plateService->getPlatesForType($type);

        return $this->json($plates, Response::HTTP_OK);
    }

}
