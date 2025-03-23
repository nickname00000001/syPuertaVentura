<?php

namespace App\Service;

use App\Entity\Entry;
use App\Entity\Food;
use App\Entity\Pay;
use App\Entity\PaymentEntry;
use App\Entity\PlatesOrder;
use App\Entity\Service;
use App\Entity\ServicePerEntry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;
use App\Repository\EntryRepository;
use App\Repository\OrderRepository;
use App\Repository\PaymentEntryRepository;
use App\Repository\PayRepository;
use App\Repository\ServicePerEntryRepository;
use App\Repository\ServiceRepository;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Mime\Address;

class PayServices
{

    private EntityManagerInterface $entityManagerInterface;

    private PaymentEntryRepository $payER;

    private PayRepository $pay;

    private EntryRepository $entryR;

    private Service $service;

    private Food $food;

    private Order $order;

    private ServicePerEntryRepository $serviceEntryRepository;

    private ServiceRepository $serviceRepository;

    private OrderRepository $orderRepository;



    public function __construct(OrderRepository $orderRepository,Food $food,Order $order,ServiceRepository $serviceRepositrory,ServicePerEntryRepository $serviceEntryRepository, Service $service, PaymentEntryRepository $payER, PayRepository $pay, EntryRepository $entryR, EntityManagerInterface $entityManagerInterface, private Security $security)
    {
        $this->payER = $payER;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->pay = $pay;
        $this->food = $food;
        $this->order = $order;
        $this->entryR = $entryR;
        $this->service = $service;
        $this->serviceEntryRepository = $serviceEntryRepository;
        $this->serviceRepository = $serviceRepositrory;
        $this->orderRepository = $orderRepository;

    }




    ////

    public function addPaymentEntry(Request $request)
    {

        $data = $request->request->all();


        $Stypepay = $data['tipoPago'];
        $total = $data['total'];
        $nentrys = $data['nentrys'];
        $tlf = $data['tlf'];

        // returns User object or null if not authenticated
        $user = $this->security->getUser();

        $payEntry = new PaymentEntry();


        $this->payER->createPaymentEntry($payEntry);


        $pay = new Pay();

        //creo un pago
        $this->pay->createPayEntry($pay, $Stypepay, $user, $total);


        //Al pago le añado e payentry id
        $this->pay->addPaymentEntry($pay, $payEntry);

        for ($i = 0; $i < $nentrys; $i++) {
            $entry = new Entry();
            $this->entryR->createEntry($entry, $tlf);

            //A cada entrada le paso el id del payentry
            $this->entryR->addEntryPayment($entry, $payEntry);
        }
    }


    //arreglar bien esto--------------------------------------------->>>>>>>>>>>>>>>>>>>>


    public function eating(Entry $entry)
    {

        $service = new Service();

        //type service es de tipo enum se envia en estring y ya se convierte en el repository 
        $this->serviceRepository->createSevice($service, $tlf, $npersonas,$typeService);

        $food = new Food();

        $order = new Order();

        //tipe string con el status de la orden entrado o pendiente
        $this->orderRepository->createOrder($tipe,$food);

        $session = $request->getSession();
        $platos = $session->get('platos', []);



        foreach ($platos as $platoId => $cantidad) {



            buscar el plato con id 1 ejmp
            

            $plateOrder = new PlatesOrder();
            $this->plateOrderRepository->createPlatesOrder($idPlate, $orden,$cantidad);




        }


        calcular total
        
        $this->foodService->createFood($eat,total,$serviceAssociate);


        //asociar el servicio creado a la entrada

        $servicePE = new ServicePerEntry();


        $service->addIdService($servicePE);
        $entry->addIdEntry($servicePE);

        $this->serviceEntryRepository->createServicePerEntry($servicePE,$service,$entry);

        

         //asociar el servicio a el usuario

        $serviceUser = new ServiceUser();
        $this->serviceUserRepository->createServiceUser($serviceUser,$service,$user);






    }



}
