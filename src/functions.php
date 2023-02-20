<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry;

use Zenstruck\Foundry\Object\ObjectFactory;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @template T of object
 *
 * @param class-string<T> $class
 *
 * @return ObjectFactory<T>|PersistentObjectFactory<T>
 */
function factory(string $class): ObjectFactory|PersistentObjectFactory
{
    return FactoryManager::createAnonymousFactory($class);
}

// examples
// factory(Object::class)->create($attributes);
// factory(Object::class)::first();
