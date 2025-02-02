<?php

namespace App\Factory;

use App\Entity\PaymentEntry;
use App\Enum\PaymentStatus;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use function Zenstruck\Foundry\faker;

/**
 * @extends PersistentProxyObjectFactory<PaymentEntry>
 */
final class PaymentEntryFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return PaymentEntry::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'statusP' => faker()->randomElement(PaymentStatus::cases()),
            'DatePayment' => faker()->dateTime(),
            // Agrega aquí otros campos de la entidad PaymentEntry
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(PaymentEntry $paymentEntry): void {})
        ;
    }
}
