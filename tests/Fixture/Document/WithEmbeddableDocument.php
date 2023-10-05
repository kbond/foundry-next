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

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Zenstruck\Foundry\Tests\Fixture\Model\Embeddable;
use Zenstruck\Foundry\Tests\Fixture\Model\WithEmbeddable;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
#[MongoDB\Document]
class WithEmbeddableDocument extends WithEmbeddable
{
    #[MongoDB\EmbedOne(targetDocument: MongoEmbeddable::class)]
    protected Embeddable $embeddable;

    #[MongoDB\EmbedMany(targetDocument: MongoEmbeddable::class)]
    protected Collection $embeddables;
}