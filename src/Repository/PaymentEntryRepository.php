<?php

namespace App\Repository;

use App\Entity\PaymentEntry;
use App\Enum\PaymentStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Faker\Provider\ar_EG\Payment;

/**
 * @extends ServiceEntityRepository<PaymentEntry>
 */
class PaymentEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentEntry::class);
    }

    //    /**
    //     * @return PaymentEntry[] Returns an array of PaymentEntry objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PaymentEntry
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


    public function createPaymentEntry(PaymentEntry $payEntry): void
    {
    
        // case s1 = 'Pagado';
        // case s2 = 'Pendiente'; PaymentStatus
        
        $payEntry->setStatusP(PaymentStatus::s1);
        $payEntry->setDatePayment(new \DateTime());
        
        $this->getEntityManager()->persist($payEntry);
        $this->getEntityManager()->flush();
    }


}
