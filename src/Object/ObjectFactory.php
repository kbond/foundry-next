<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Object;

use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\FactoryManager;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @extends Factory<T>
 * @phpstan-import-type Parameters from Factory
 * @phpstan-import-type Attributes from Factory
 */
abstract class ObjectFactory extends Factory
{
    /** @var Instantiator|\Closure(Parameters,class-string<T>):T */
    private \Closure|Instantiator $instantiator;

    /** @var array<callable(Parameters,class-string<T>):Parameters> */
    private array $beforeInstantiate = [];

    /** @var array<callable(T,Parameters):void> */
    private array $afterInstantiate = [];

    /**
     * @return class-string<T>
     */
    abstract public static function class(): string;

    public function create(array|callable $attributes = []): object
    {
        return $this->normalizeAndInstantiate($attributes)[0];
    }

    /**
     * @param string|callable(Parameters,class-string<T>):T $factory
     */
    final public function instantiateWith(string|callable $factory): static
    {
        if (\is_string($factory) && \method_exists(static::class(), $factory)) {
            $factory = Instantiator::with($factory);
        }

        if (!\is_callable($factory)) {
            throw new \LogicException(); // todo
        }

        if (!$factory instanceof Instantiator) {
            $factory = $factory(...);
        }

        $clone = clone $this;
        $clone->instantiator = $factory;

        return $clone;
    }

    final public function instantiateWithConstructor(): static
    {
        $clone = clone $this;
        $clone->instantiator = Instantiator::withConstructor();

        return $clone;
    }

    final public function instantiateWithoutConstructor(): static
    {
        $clone = clone $this;
        $clone->instantiator = Instantiator::withoutConstructor();

        return $clone;
    }

    /**
     * @param callable(Parameters,class-string<T>):Parameters $callback
     */
    final public function beforeInstantiate(callable $callback): static
    {
        $clone = clone $this;
        $this->beforeInstantiate[] = $callback;

        return $clone;
    }

    /**
     * @param callable(T,Parameters):void $callback
     */
    final public function afterInstantiate(callable $callback): static
    {
        $clone = clone $this;
        $this->afterInstantiate[] = $callback;

        return $clone;
    }

    /**
     * @param Attributes $attributes
     *
     * @return array{0:T,1:Parameters}
     */
    final protected function normalizeAndInstantiate(array|callable $attributes = []): array
    {
        $parameters = $this->normalizedAttributes($attributes);

        foreach ($this->beforeInstantiate as $hook) {
            $parameters = \array_merge($parameters, $hook($parameters, static::class()));
        }

        $object = ($this->instantiator ?? FactoryManager::defaultObjectInstantiator())($parameters, static::class());

        foreach ($this->afterInstantiate as $hook) {
            $hook($object, $parameters);
        }

        return [$object, $parameters];
    }
}
