<?php

namespace App\Repository;

use App\Entity\Entry;
use App\Entity\PaymentEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Entry>
 */
class EntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entry::class);
    }

    //    /**
    //     * @return Entry[] Returns an array of Entry objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Entry
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }



    public function createEntry(Entry $entry,$tlf): void
    {
    
        $entry->setDateEntry(new \DateTime());
        $entry->setAge(18);
        $entry->setTlf($tlf);
        $this->getEntityManager()->persist($entry);
        $this->getEntityManager()->flush();
    }

    public function addEntryPayment(Entry $entry,PaymentEntry $idEntry): void
    {
        
        $entry->addIdPay($idEntry);
        $this->getEntityManager()->persist($entry);
        $this->getEntityManager()->flush();
    }

}
