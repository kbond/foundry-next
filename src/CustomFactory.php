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
 * @template T
 * @template F of Factory
 * @mixin F<T>
 *
 * @phpstan-import-type Parameters from Factory
 * @phpstan-import-type Attributes from Factory
 */
abstract class CustomFactory
{
    /** @var F */
    private Factory $factory;

    protected function __construct()
    {
        $this->factory = static::createFactory();
    }

    final public function __call(string $name, array $arguments): static
    {
        if (!\is_callable($this->factory, $name)) {
            throw new \BadMethodCallException();
        }

        $clone = clone $this;
        $clone->factory = $this->factory->{$name}(...$arguments);

        return $clone;
    }

    /**
     * @param Attributes $attributes
     */
    public static function new(array|callable $attributes = []): static
    {
    }

    /**
     * @param Attributes $attributes
     *
     * @return T
     */
    public static function createOne(array|callable $attributes = []): mixed
    {
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
    }

    /**
     * @return Parameters
     */
    abstract protected function getDefaults(): array;

    /**
     * @internal
     *
     * @return F
     */
    abstract protected static function createFactory(): Factory;
}
