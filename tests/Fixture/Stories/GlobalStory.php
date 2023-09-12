<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Fixture\Stories;

use Zenstruck\Foundry\Story;
use Zenstruck\Foundry\Tests\Fixture\Document\GlobalDocument;
use Zenstruck\Foundry\Tests\Fixture\Entity\GlobalEntity;

use function Zenstruck\Foundry\Persistence\persist_object;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class GlobalStory extends Story
{
    public function build(): void
    {
        if (\getenv('DATABASE_URL')) {
            persist_object(GlobalEntity::class);
        }

        if (\getenv('MONGO_URL')) {
            persist_object(GlobalDocument::class);
        }
    }
}
