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
 * @internal
 *
 * @template T of object
 */
trait CustomObjectFactory
{
    /** @use CustomFactory<T> */
    use CustomFactory;

    public function __construct()
    {
        parent::__construct(static::class());
    }

    /**
     * @return class-string<T>
     */
    abstract public function class(): string;
}
