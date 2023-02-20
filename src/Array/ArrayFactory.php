<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Array;

use Zenstruck\Foundry\Factory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @phpstan-import-type Parameters from Factory
 * @extends Factory<array>
 */
abstract class ArrayFactory extends Factory
{
    /**
     * @return Parameters
     */
    final public function create(array|callable $attributes = []): array
    {
        return $this->normalizedAttributes($attributes);
    }
}
