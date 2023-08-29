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
 * @phpstan-import-type Parameters from Factory
 */
final class LazyValue
{
    /** @var \Closure():mixed */
    private \Closure $factory;
    private mixed $memoizedValue;

    /**
     * @param callable():mixed $factory
     */
    private function __construct(callable $factory, private bool $memoize = false)
    {
        $this->factory = $factory(...);
    }

    /**
     * @internal
     */
    public function __invoke(): mixed
    {
        if ($this->memoize && isset($this->memoizedValue)) {
            return $this->memoizedValue;
        }

        $value = ($this->factory)();

        if ($this->memoize) {
            return $this->memoizedValue = $value;
        }

        return $value;
    }

    public static function new(callable $factory): self
    {
        return new self($factory, false);
    }

    public static function memoize(callable $factory): self
    {
        return new self($factory, true);
    }
}
