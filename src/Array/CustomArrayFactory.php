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
 */
abstract class CustomArrayFactory extends ArrayFactory
{
    /** @use CustomFactory<array> */
    use CustomFactory;
}
