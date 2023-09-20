<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Fixture\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
#[MongoDB\EmbeddedDocument]
final class Embeddable
{
    #[MongoDB\Field(type: 'string')]
    private string $prop1;

    public function __construct(string $prop1)
    {
        $this->prop1 = $prop1;
    }

    public function getProp1(): string
    {
        return $this->prop1;
    }
}