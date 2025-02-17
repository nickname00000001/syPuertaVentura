<?php

namespace App\Repository;

use App\Entity\Pay;
use App\Entity\PaymentEntry;
use App\Entity\User;
use App\Enum\PaymentMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pay>
 */
class PayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pay::class);
    }

    //    /**
    //     * @return Pay[] Returns an array of Pay objects
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

    //    public function findOneBySomeField($value): ?Pay
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function createPay($typePay, $iduser,$total): void
    {
    
        if ($typePay == 'efectivo')  {
            $typeP = PaymentMethod::p1;
        }else  $typeP = PaymentMethod::p2;

        $pay = new Pay();
        $pay->setIdUser($iduser);
        $pay->setTotal($total);
        $pay->setTypeP($typeP);
        $pay->setPaymentDate(new \DateTime());
        $this->getEntityManager()->persist($pay);
        $this->getEntityManager()->flush();
    }

    public function createPayEntry(Pay $pay,$typePay,User $iduser,$total): void
    {
    
        if ($typePay == 'efectivo')  {
            $typeP = PaymentMethod::p1;
        }else  $typeP = PaymentMethod::p2;

        
        $pay->setIdUser($iduser);
        $pay->setTotal($total);
        $pay->setTypeP($typeP);
        $pay->setPaymentDate(new \DateTime());
        $this->getEntityManager()->persist($pay);
        $this->getEntityManager()->flush();
    }

    public function addPaymentEntry(Pay $pay,PaymentEntry $idEntry): void
    {
        
        $pay->addPayId($idEntry);
        $this->getEntityManager()->persist($pay);
        $this->getEntityManager()->flush();
    }

}
