<?php

namespace App\Repository;

use App\Entity\ServicePerEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ServicePerEntry>
 */
class ServicePerEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServicePerEntry::class);
    }

    //    /**
    //     * @return ServicePerEntry[] Returns an array of ServicePerEntry objects
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

    //    public function findOneBySomeField($value): ?ServicePerEntry
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function createServiceEntry($servicio, $entrada): void
    {
    
        $serviceEntry = new ServicePerEntry();
        $serviceEntry->addService($servicio);
        $serviceEntry->addEntry($entrada);
        $this->getEntityManager()->persist($serviceEntry);
        $this->getEntityManager()->flush();
    }
}
