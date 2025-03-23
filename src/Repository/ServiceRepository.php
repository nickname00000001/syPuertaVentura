<?php

namespace App\Repository;

use App\Entity\Service;
use App\Enum\ServiceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Service>
 */
class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }

    //    /**
    //     * @return Service[] Returns an array of Service objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Service
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function createService(Service $service,$tlf, $npersonas,$nameSevice): void
    {

        if ($nameSevice == 'Comida') {
            $nameSevice = ServiceType::uno;
        } else  $nameSevice = ServiceType::dos;

        $service->setPhoneNumber($tlf);
        $service->setNumberPeople($npersonas);
        $service->setType($nameSevice);
        $this->getEntityManager()->persist($service);
        $this->getEntityManager()->flush();
    }
}
