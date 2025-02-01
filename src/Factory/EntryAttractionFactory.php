<?php

namespace App\Factory;

use App\Entity\EntryAttraction;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use function Zenstruck\Foundry\faker;

/**
 * @extends PersistentProxyObjectFactory<EntryAttraction>
 */
final class EntryAttractionFactory extends PersistentProxyObjectFactory
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
        return EntryAttraction::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'entryTime' => faker()->dateTime(),
            'exitTime' => faker()->dateTime(),
            // Agrega aquí otros campos de la entidad EntryAttraction
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(EntryAttraction $entryAttraction): void {})
        ;
    }
}
