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
use Zenstruck\Foundry\Persistence\ObjectManager;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @internal
 *
 * @phpstan-import-type Parameters from Factory
 */
final class FactoryManager
{
    /**
     * @template T of Factory
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    public static function create(string $class): Factory
    {
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return ObjectFactory<T>|PersistentObjectFactory<T>
     */
    public static function createAnonymousFactory(string $class): ObjectFactory|PersistentObjectFactory
    {
    }

    /**
     * @template T of object
     *
     * @return callable(Parameters,class-string<T>):T
     */
    public static function defaultObjectInstantiator(): callable
    {
    }

    /**
     * @param class-string $class
     */
    public static function objectManagerFor(string $class): ObjectManager
    {
    }

    /**
     * @return ObjectManager[]
     */
    public static function objectManagers(): iterable
    {
    }

    /**
     * @template T of object
     *
     * @param T $object
     *
     * @return T&Proxy
     */
    public static function createProxy(object $object): object
    {
    }
}
