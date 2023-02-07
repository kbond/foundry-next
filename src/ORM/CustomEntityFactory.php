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

use Zenstruck\Foundry\Persistence\CustomPersistenceObjectFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @template F of EntityFactory
 * @extends CustomPersistenceObjectFactory<T,F>
 */
abstract class CustomEntityFactory extends CustomPersistenceObjectFactory
{
    /**
     * @internal
     */
    final protected static function createFactory(): EntityFactory
    {
        return new EntityFactory([static::class, 'class']());
    }
}
