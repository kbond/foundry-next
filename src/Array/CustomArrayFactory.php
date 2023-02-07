<?php

/*
 * This file is part of the zenstruck/{name} package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Array;

use Zenstruck\Foundry\CustomFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @extends CustomFactory<array,ArrayFactory>
 */
abstract class CustomArrayFactory extends CustomFactory
{
    /**
     * @internal
     */
    final protected static function createFactory(): ArrayFactory
    {
        return new ArrayFactory();
    }
}
