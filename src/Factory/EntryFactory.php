<?php

namespace App\Factory;

use App\Entity\Entry;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use function Zenstruck\Foundry\faker;

/**
 * @extends PersistentProxyObjectFactory<Entry>
 */
final class EntryFactory extends PersistentProxyObjectFactory
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
        return Entry::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'entryDate' => faker()->dateTime(),
            'ticketNumber' => faker()->unique()->numberBetween(1000, 9999),
            // Agrega aquí otros campos de la entidad Entry
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Entry $entry): void {})
        ;
    }
}
