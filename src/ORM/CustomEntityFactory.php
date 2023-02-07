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

use Zenstruck\Foundry\Persistence\ExtendablePersistenceObjectFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @extends EntityFactory<T>
 */
abstract class CustomEntityFactory extends EntityFactory
{
    /** @use ExtendablePersistenceObjectFactory<T> */
    use ExtendablePersistenceObjectFactory;
}
