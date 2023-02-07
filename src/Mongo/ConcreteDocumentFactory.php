<?php

namespace Zenstruck\Foundry\Mongo;

use Zenstruck\Foundry\Persistence\CustomPersistenceObjectFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @extends DocumentFactory<T>
 */
abstract class ConcreteDocumentFactory extends DocumentFactory
{
    /** @use CustomPersistenceObjectFactory<T> */
    use CustomPersistenceObjectFactory;
}
