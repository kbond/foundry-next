<?php

/*
 * This file is part of the zenstruck/{name} package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @immutable
 *
 * @template T
 * @phpstan-type Parameters = array<string,mixed>
 * @phpstan-type Attributes = Parameters|callable():array<string,mixed>
 */
abstract class Factory
{
    /**
     * @param Attributes $attributes
     */
    public function __construct(array|callable $attributes = [])
    {
    }

    /**
     * @param Attributes $attributes
     *
     * @return T
     */
    abstract public function create(array|callable $attributes = []): mixed;

    /**
     * @param Attributes $attributes
     */
    final public function withAttributes(array|callable $attributes = []): static
    {
    }

    /**
     * @return Parameters
     */
    protected function normalizeAttributes(): array
    {
    }
}
