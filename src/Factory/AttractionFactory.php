<?php

namespace App\Factory;

use App\Entity\Attraction;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use function Zenstruck\Foundry\faker;

/**
 * @extends PersistentProxyObjectFactory<Attraction>
 */
final class AttractionFactory extends PersistentProxyObjectFactory
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
        return Attraction::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'Name' => faker()->word(),
            'Ability' => faker()->numberBetween(1, 10),
            'OpenTime' => faker()->dateTime(),
            'CloseTime' => faker()->dateTime(),
            'AgeMin' => faker()->numberBetween(5, 18),
            'Cost' => faker()->randomFloat(2, 10, 100),
            // Agrega aquí otros campos de la entidad Attraction
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Attraction $attraction): void {})
        ;
    }
}
