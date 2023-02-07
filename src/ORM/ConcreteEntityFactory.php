<?php

namespace Zenstruck\Foundry\ORM;

use Zenstruck\Foundry\Persistence\CustomPersistenceObjectFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @extends EntityFactory<T>
 */
abstract class ConcreteEntityFactory extends EntityFactory
{
    /** @use CustomPersistenceObjectFactory<T> */
    use CustomPersistenceObjectFactory;
}
