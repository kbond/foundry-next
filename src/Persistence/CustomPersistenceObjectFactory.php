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

use Zenstruck\Foundry\Factory;
use Zenstruck\Foundry\Object\CustomObjectFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @internal
 *
 * @template T of object
 * @phpstan-import-type Parameters from Factory
 */
trait CustomPersistenceObjectFactory
{
    /** @use CustomObjectFactory<T> */
    use CustomObjectFactory;

    /**
     * @param Parameters $attributes
     *
     * @return T&Proxy
     */
    final public static function findOrCreate(array $attributes): object
    {
    }

    /**
     * @return T&Proxy
     */
    final public static function first(string $sortedField = 'id'): object
    {
    }

    /**
     * @return T&Proxy
     */
    final public static function last(string $sortedField = 'id'): object
    {
    }

    /**
     * @param Parameters $attributes
     *
     * @return T&Proxy
     */
    final public static function random(array $attributes): object
    {
    }

    /**
     * @param Parameters $attributes
     *
     * @return T&Proxy
     */
    final public static function randomOrCreate(array $attributes): object
    {
    }

    /**
     * @param Parameters|mixed $attributes
     *
     * @return T&Proxy
     */
    final public static function get(mixed $attributes): object
    {
    }

    final public static function count(array $criteria = []): int
    {
    }

    final public static function truncate(): void
    {
    }
}
