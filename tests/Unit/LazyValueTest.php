<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Unit;

use PHPUnit\Framework\TestCase;

use function Zenstruck\Foundry\lazy;
use function Zenstruck\Foundry\memoize;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class LazyValueTest extends TestCase
{
    /**
     * @test
     */
    public function lazy(): void
    {
        $value = lazy(fn() => new \stdClass());

        $this->assertNotSame($value(), $value());
    }

    /**
     * @test
     */
    public function memoize(): void
    {
        $value = memoize(fn() => new \stdClass());

        $this->assertSame($value(), $value());
    }
}
