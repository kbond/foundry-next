<?php

/*
 * This file is part of the zenstruck/{name} package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\ORM;

use Zenstruck\Foundry\Persistence\PersistenceObjectFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @extends PersistenceObjectFactory<T>
 */
class EntityFactory extends PersistenceObjectFactory
{
    protected function persist(object $object): void
    {
        // TODO: Implement persist() method.
    }
}
