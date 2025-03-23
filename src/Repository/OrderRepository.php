<?php

namespace App\Repository;

use App\Entity\Order;
use App\Enum\StatusOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    //    /**
    //     * @return Order[] Returns an array of Order objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Order
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function createOrder($comidaAsociada,$orderTipe): void
    {

        // o1= entregado o2= pendiente
        if ($orderTipe == 'Comida') {
            $orderTipe = StatusOrder::o1;
        } else  $orderTipe = StatusOrder::o2;
        
        $order = new Order();
        $order->setStatus($orderTipe);
        $order->setFoodOrder($comidaAsociada);
        $this->getEntityManager()->persist($order);
        $this->getEntityManager()->flush();
    }
}
