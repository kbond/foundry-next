<?php

/*
 * This file is part of the zenstruck/{name} package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Mongo;

use Zenstruck\Foundry\Persistence\CustomPersistenceObjectFactory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @template F of DocumentFactory
 * @extends CustomPersistenceObjectFactory<T,F>
 */
abstract class CustomDocumentFactory extends CustomPersistenceObjectFactory
{
    /**
     * @internal
     */
    final protected static function createFactory(): DocumentFactory
    {
        return new DocumentFactory([static::class, 'class']());
    }
}
