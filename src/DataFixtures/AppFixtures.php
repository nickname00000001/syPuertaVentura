<?php

namespace App\DataFixtures;

use App\Factory\OrderFactory;
use App\Factory\UserFactory;
use App\Factory\UserServiceFactory;
use App\Factory\PayFactory;
use App\Factory\ServiceFactory;
use App\Factory\PlatesOrderFactory;
use App\Factory\PlateFactory;
use App\Factory\PaymentEntryFactory;
use App\Factory\FoodFactory;
use App\Factory\EntryFactory;
use App\Factory\EntryAttractionFactory;
use App\Factory\AttractionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Crear 10 comidas
        FoodFactory::createMany(10);

        // Crear 10 órdenes
        OrderFactory::createMany(10);

        // Crear 10 atracciones
        AttractionFactory::createMany(10);

        // Crear 10 usuarios
        UserFactory::createMany(10);

        // Crear 10 servicios de usuario
        UserServiceFactory::createMany(10);

        // Crear 10 pagos
        PayFactory::createMany(10);

        // Crear 10 servicios
        ServiceFactory::createMany(10);

        // Crear 10 órdenes de platos
        PlatesOrderFactory::createMany(10);

        // Crear 10 platos
        PlateFactory::createMany(10);

        // Crear 10 entradas de pago
        PaymentEntryFactory::createMany(10);

        // Crear 10 entradas
        EntryFactory::createMany(10);

        // Crear 10 entradas de atracción
        EntryAttractionFactory::createMany(10);

        

        $manager->flush();
    }
}
