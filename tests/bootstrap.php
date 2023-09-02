<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Filesystem\Filesystem;

require \dirname(__DIR__).'/vendor/autoload.php';

(new Filesystem())->remove(__DIR__.'/../var');

if (\file_exists($env = __DIR__.'/../.env')) {
    (new Dotenv())->usePutenv()->load($env);
}