<?php

namespace App\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use App\Entity\User;
use App\Entity\UserService;
use App\Service\UserServices;

//Esto es para no tener que poner /api en todas las rutas ya que se entiende que todas van a tener /api
#[Route('/api', name: 'app_api_user')]

final class UserController extends AbstractController
{

    private UserServices $userService;


    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }


    //------------methods: -----------------------------------------


    #[Route('/get',methods:['POST'],name: 'user_get')]
    public function listUsers(): Response
    {
        $users = $this->userService->getAllUsers();

        return $this->json($users, Response::HTTP_OK);
    }


  /* registro de video
    #[Route('/userRegisterOtro',methods:['POST'], name: 'user_registerOtro')]

    public function Register(Request $request): Response
    {
        $this->userService->registerUsers($request);

        return $this->json("User created", Response::HTTP_CREATED);
    }
 */

    #[Route('/delete', name: 'user_delete')]
    public function Delete(Request $request): Response
    {
        $this->userService->userDelete($request);
        return $this->json("Usuario Borrado con exito", Response::HTTP_OK);
    }
}
