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
use Zenstruck\Foundry\LazyValue;
use Zenstruck\Foundry\Tests\Fixture\StandaloneArrayFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class ArrayFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function can_create_with_defaults(): void
    {
        $this->assertSame(
            [
                'default1' => 'default value 1',
                'default2' => 'default value 2',
            ],
            StandaloneArrayFactory::createOne()
        );
    }

    /**
     * @test
     */
    public function can_create_with_overrides(): void
    {
        $this->assertSame(
            [
                'default1' => 'default value 1',
                'default2' => 'override value 2',
                'foo' => 'baz',
            ],
            StandaloneArrayFactory::new(['foo' => 'bar'])
                ->with(fn() => ['foo' => LazyValue::new(fn() => 'baz')])
                ->create(['default2' => 'override value 2'])
        );
    }
}
