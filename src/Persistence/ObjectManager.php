<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Persistence;

use Doctrine\Persistence\ObjectManager as BaseObjectManager;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
interface ObjectManager extends BaseObjectManager
{
    public function resetDatabase(): void;

    public function resetDatabaseSchema(): void;

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return RepositoryDecorator<T>
     */
    public function getRepository(string $class): RepositoryDecorator;
}
