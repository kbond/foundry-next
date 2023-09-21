<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Fixture\Factories;

use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Tests\Fixture\Model\GenericModel;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @extends PersistentProxyObjectFactory<GenericModel>
 */
abstract class GenericProxyModelFactory extends PersistentProxyObjectFactory
{
    protected function defaults(): array|callable
    {
        return [
            'prop1' => 'default1',
        ];
    }
}
