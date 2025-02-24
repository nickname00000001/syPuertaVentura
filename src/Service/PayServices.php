<?php
namespace App\Service;

use App\Entity\Entry;
use App\Entity\Pay;
use App\Entity\PaymentEntry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;
use App\Repository\EntryRepository;
use App\Repository\PaymentEntryRepository;
use App\Repository\PayRepository;
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


    public function __construct(PaymentEntryRepository $payER,PayRepository $pay,EntryRepository $entryR, EntityManagerInterface $entityManagerInterface,private Security $security)
    {
        $this->payER = $payER;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->pay = $pay;
        $this->entryR = $entryR;


    }




    ////

    public function addPaymentEntry( Request $request)
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
        $this->pay->createPayEntry($pay,$Stypepay,$user,$total);


        //Al pago le añado e payentry id
        $this->pay->addPaymentEntry($pay,$payEntry);

        for ($i = 0; $i < $nentrys; $i++) {
            $entry = new Entry();
            $this->entryR->createEntry($entry,$tlf);

            //A cada entrada le paso el id del payentry
            $this->entryR->addEntryPayment($entry,$payEntry);

            
            
        }
        
        
    }




}
