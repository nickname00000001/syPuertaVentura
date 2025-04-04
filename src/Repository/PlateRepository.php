<?php

namespace App\Repository;

use App\Entity\Plate;
use App\Enum\TypePlate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Plate>
 */
class PlateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plate::class);
    }

        /**
         * @return Plate[] Returns an array of Plate objects
         */
        public function findByTplate($value): array
        {
            return $this->createQueryBuilder('p')//alias para la entidad
                ->andWhere('p.tplate = :val')
                ->setParameter('val', $value)//Se asigna el valor para el val de arriva
                ->orderBy('p.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }

        

        public function findOneBySomeField($value): ?Plate
        {
            return $this->createQueryBuilder('p')
                ->andWhere('p.tplate = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }


        public function createPlate($typePlate,$nombre,$descripcion,$precio,$stock): void
    {
    
        if ($typePlate == 'Entrante')  {
            $typePlate = TypePlate::p1;
        }else if($typePlate == 'Segundo'){
            $typePlate = TypePlate::p2;
        }else  $typePlate = TypePlate::p3;

        $plate = new Plate();
        $plate->setTPlate($typePlate);
        $plate->setName($nombre);
        $plate->setDescription($descripcion);
        $plate->setValue($precio);
        $plate->setStock($stock);
        $this->getEntityManager()->persist($plate);
        $this->getEntityManager()->flush();
    }


}
