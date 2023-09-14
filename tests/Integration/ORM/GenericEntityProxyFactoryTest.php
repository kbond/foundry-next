<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Integration\ORM;

use Zenstruck\Foundry\Tests\Fixture\Factories\Entity\GenericEntityProxyFactory;
use Zenstruck\Foundry\Tests\Fixture\Factories\GenericModelProxyFactory;
use Zenstruck\Foundry\Tests\Integration\Persistence\GenericProxyFactoryTestCase;
use Zenstruck\Foundry\Tests\Integration\RequiresORM;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class GenericEntityProxyFactoryTest extends GenericProxyFactoryTestCase
{
    use RequiresORM;

    protected function factory(): GenericModelProxyFactory
    {
        return GenericEntityProxyFactory::new();
    }
}
