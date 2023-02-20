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
    /** @var array<callable():array<string,mixed>> */
    private array $attributes = [];

    /**
     * @param Attributes $attributes
     */
    final public static function new(array|callable $attributes = []): static
    {
        return FactoryManager::create(static::class)->withAttributes($attributes);
    }

    /**
     * @param Attributes $attributes
     *
     * @return T
     */
    final public static function createOne(array|callable $attributes = []): mixed
    {
        return static::new($attributes)->create();
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
    final public function withAttributes(array|callable $attributes): static
    {
        if (!$attributes) {
            return $this;
        }

        $clone = clone $this;
        $clone->attributes[] = \is_callable($attributes) ? $attributes : static fn() => $attributes;

        return $clone;
    }

    /**
     * @param Attributes $attributes
     *
     * @return Parameters
     */
    protected function normalizedAttributes(array|callable $attributes): array
    {
        $attributes = $attributes ? \array_merge($this->attributes, \is_callable($attributes) ? $attributes() : $attributes) : $this->attributes;

        return [
            $this->getDefaults(),
            ...\array_map(static fn(callable $attr): array => $attr(), $attributes),
        ];
    }

    protected function initialize(): static
    {
        return $this;
    }

    /**
     * @param Attributes $attributes
     */
    final protected function addState(array|callable $attributes = []): static
    {
        return $this->withAttributes($attributes);
    }

    /**
     * @return Parameters
     */
    abstract protected function getDefaults(): array;
}
