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

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
interface Proxy
{
    public function _save(): static;
}
