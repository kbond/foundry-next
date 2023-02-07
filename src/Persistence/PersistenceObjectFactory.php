<?php

/*
 * This file is part of the zenstruck/{name} package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Persistence;

use Zenstruck\Foundry\Object\ObjectFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @extends ObjectFactory<T>
 */
abstract class PersistenceObjectFactory extends ObjectFactory
{
    /**
     * @return T&Proxy
     */
    public function create(array|callable $attributes = []): object
    {
        $object = parent::create($attributes);

        $this->persist($object);

        // call post-persist hooks

        // wrap in proxy

        return $object;
    }

    final public function withoutPersisting(): static
    {
    }

    final public function afterPersist(callable $callback): static
    {
    }

    abstract protected function persist(object $object): void;
}
