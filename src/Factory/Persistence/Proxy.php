<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Factory\Persistence;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
interface Proxy
{
    public function _enableAutoRefresh(): static;

    public function _disableAutoRefresh(): static;

    public function _save(): static;

    public function _refresh(): static;

    public function _delete(): static;

    /**
     * @return RepositoryDecorator<self>
     */
    public function _repo(): RepositoryDecorator;
}