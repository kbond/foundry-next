<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Persistence;

use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\FactoryManager;
use Zenstruck\Foundry\Object\ObjectFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @extends ObjectFactory<T>
 * @phpstan-import-type Parameters from Factory
 */
abstract class PersistentObjectFactory extends ObjectFactory
{
    /** @var array<callable(T&Proxy,Parameters):void> */
    private array $afterPersist = [];
    private bool $persist = true;

    /**
     * @param Parameters $attributes
     *
     * @return T&Proxy
     */
    final public static function findOrCreate(array $attributes): object
    {
        return static::repository()->findOrCreate($attributes);
    }

    /**
     * @return T&Proxy
     */
    final public static function first(string $sortedField = 'id'): object
    {
        return static::repository()->first($sortedField);
    }

    /**
     * @return T&Proxy
     */
    final public static function last(string $sortedField = 'id'): object
    {
        return static::repository()->last($sortedField);
    }

    /**
     * @return (T&Proxy)[]
     */
    final public static function all(): array
    {
        return static::repository()->all();
    }

    /**
     * @param Parameters $attributes
     *
     * @return (T&Proxy)[]
     */
    final public static function findBy(array $attributes): array
    {
        return static::repository()->findBy($attributes);
    }

    /**
     * @param Parameters $attributes
     *
     * @return T&Proxy
     */
    final public static function random(array $attributes): object
    {
        return static::repository()->random($attributes);
    }

    /**
     * @param Parameters $attributes
     *
     * @return T&Proxy
     */
    final public static function randomOrCreate(array $attributes): object
    {
        return static::repository()->randomOrCreate($attributes);
    }

    /**
     * @param Parameters $attributes
     *
     * @return (T&Proxy)[]
     */
    final public static function randomSet(int $number, array $attributes = []): array
    {
        return static::repository()->randomSet($number, $attributes);
    }

    /**
     * @param Parameters $attributes
     *
     * @return (T&Proxy)[]
     */
    final public static function randomRange(int $min, int $max, array $attributes = []): array
    {
        return static::repository()->randomRange($min, $max, $attributes);
    }

    /**
     * @param Parameters|mixed $attributes
     *
     * @return T&Proxy
     */
    final public static function get(mixed $attributes): object
    {
        return static::repository()->get($attributes);
    }

    /**
     * @param Parameters $attributes
     */
    final public static function count(array $attributes = []): int
    {
        return static::repository()->count($attributes);
    }

    final public static function truncate(): void
    {
        static::repository()->truncate();
    }

    /**
     * @return RepositoryDecorator<T>
     */
    final public static function repository(): RepositoryDecorator
    {
        return FactoryManager::objectManagerFor(static::class())->getRepository(static::class());
    }

    /**
     * @return T&Proxy
     */
    final public function create(array|callable $attributes = []): object
    {
        [$object, $parameters] = $this->normalizeAndInstantiate($attributes);

        $object = FactoryManager::createProxy($object);

        if (!$this->persist) {
            return $object;
        }

        $object->_save();

        foreach ($this->afterPersist as $hook) {
            $hook($object, $parameters);
        }

        return $object;
    }

    final public function withoutPersisting(): static
    {
        $clone = clone $this;
        $clone->persist = false;

        return $clone;
    }

    /**
     * @param callable(T&Proxy,Parameters):void $callback
     */
    final public function afterPersist(callable $callback): static
    {
        $clone = clone $this;
        $clone->afterPersist[] = $callback;

        return $clone;
    }
}
