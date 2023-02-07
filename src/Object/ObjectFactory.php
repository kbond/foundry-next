<?php

/*
 * This file is part of the zenstruck/{name} package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Object;

use Zenstruck\Foundry\Factory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @extends Factory<T>
 * @phpstan-import-type Parameters from Factory
 * @phpstan-import-type Attributes from Factory
 */
class ObjectFactory extends Factory
{
    /**
     * @param class-string<T> $class
     * @param Attributes      $attributes
     */
    public function __construct(private string $class, array|callable $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function create(array|callable $attributes = []): object
    {
        $parameters = $this->normalizeAttributes();

        // call before instantiate hooks
        // instantiate
        // call after instantiate hooks

        // return object
    }

    /**
     * @param callable(Parameters,class-string<T>):T $factory
     * @param string                                 $factory Static factory method on T
     */
    final public function instantiateWith(string|callable $factory): static
    {
    }

    final public function instantiateWithConstructor(): static
    {
    }

    final public function instantiateWithoutConstructor(): static
    {
    }

    /**
     * @param callable(Parameters,class-string<T>):Parameters $callback
     */
    final public function beforeInstantiate(callable $callback): static
    {
    }

    /**
     * @param callable(T,Parameters):void $callback
     */
    final public function afterInstantiate(callable $callback): static
    {
    }
}
