<?php
namespace App\Service;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class UserServices
{

    private EntityManagerInterface $entityManagerInterface;

    private UserRepository $userRepository;


    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManagerInterface,private EmailVerifier $emailVerifier)
    {
        $this->userRepository = $userRepository;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function getUsers(): array
    {
        $users = $this->userRepository->findAll();
        $userJson = array();
        
        foreach ($users as $user) {
            $userJson[] = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'username' => $user->getUsername(),
            ];
        }

        return $userJson;
    }


    ////

    public function registerUsers( Request $request)
    {

        $passwordHasher = new UserPasswordHasherInterface();
        $body = $request->getContent();
        $data = json_decode($body, true);

        $user = new User();
        $user->setEmail($data['email']);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data['password'],
        );
        $user->setPassword($hashedPassword);


        $this->entityManagerInterface->persist($user);
        $this->entityManagerInterface->flush();
        
    }


    //funcion por defecto de symfony para registrar usuarios

    public function register(User $user, $form)
    {
        
        $passwordHasher = new UserPasswordHasherInterface();
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));

            $this->entityManagerInterface->persist($user);
            $this->entityManagerInterface->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('mailer@puertaVentura.com', 'PuertaVentura Bot'))
                    ->to((string) $user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
    }





    public function userDelete(Request $request): Response
    {

        $body = $request->getContent();
        $data = json_decode($body, true);



        $user = $this->userRepository->find($data['id']);
        if (!$user) {
            throw new AccessDeniedHttpException('User not found');
        }
        $this->entityManagerInterface->remove($user);
        $this->entityManagerInterface->flush();


        return new JsonResponse("Usuario Borrado con exito", Response::HTTP_OK);
    }

}
