<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Fixture\Factories\Entity;

use Zenstruck\Foundry\Tests\Fixture\Entity\GenericEntity;
use Zenstruck\Foundry\Tests\Fixture\Factories\GenericModelProxyFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class GenericEntityProxyFactory extends GenericModelProxyFactory
{
    public static function class(): string
    {
        return GenericEntity::class;
    }
}
