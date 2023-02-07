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

use Zenstruck\Foundry\CustomFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @template F of ObjectFactory
 * @extends CustomFactory<T,F>
 */
abstract class CustomObjectFactory extends CustomFactory
{
    /**
     * @return class-string<T>
     */
    abstract public static function class(): string;

    /**
     * @internal
     */
    protected static function createFactory(): ObjectFactory
    {
        return new ObjectFactory([static::class, 'class']());
    }
}
