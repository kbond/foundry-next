<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Unit\Factory\Persistence;

use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Factory\Persistence\Proxy;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Tests\Fixture\Entity\StandardEntity;
use Zenstruck\Foundry\Tests\Fixture\Entity\StandardRelationEntity;
use Zenstruck\Foundry\Tests\Fixture\Factories\Entity\StandardEntityFactory;

use function Zenstruck\Foundry\persistent_factory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class PersistentObjectFactoryTest extends TestCase
{
    use Factories;

    /**
     * @test
     */
    public function can_create(): void
    {
        $entity1 = StandardEntityFactory::createOne();

        $this->assertInstanceOf(StandardEntity::class, $entity1);
        $this->assertInstanceOf(Proxy::class, $entity1);
        $this->assertSame('default1', $entity1->getProp1());

        $entity2 = StandardEntityFactory::createOne(['prop1' => 'value']);

        $this->assertInstanceOf(StandardEntity::class, $entity2);
        $this->assertInstanceOf(Proxy::class, $entity2);
        $this->assertSame('value', $entity2->getProp1());
    }

    /**
     * @test
     */
    public function can_create_with_relationship(): void
    {
        $entity1 = StandardEntityFactory::createOne([
            'relation' => persistent_factory(StandardRelationEntity::class, ['prop1' => 'value']),
        ]);

        $this->assertSame('default1', $entity1->getProp1());
        $this->assertInstanceOf(StandardRelationEntity::class, $entity1->getRelation());
        $this->assertSame('value', $entity1->getRelation()->getProp1());
    }
}
