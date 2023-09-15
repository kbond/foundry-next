<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Integration\ORM;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;
use Zenstruck\Foundry\Tests\Fixture\Entity\Address;
use Zenstruck\Foundry\Tests\Fixture\Entity\Category;
use Zenstruck\Foundry\Tests\Fixture\Entity\Contact;
use Zenstruck\Foundry\Tests\Fixture\Entity\Tag;
use Zenstruck\Foundry\Tests\Fixture\Factories\Entity\Address\StandardAddressFactory;
use Zenstruck\Foundry\Tests\Fixture\Factories\Entity\Category\StandardCategoryFactory;
use Zenstruck\Foundry\Tests\Fixture\Factories\Entity\Contact\StandardContactFactory;
use Zenstruck\Foundry\Tests\Fixture\Factories\Entity\Tag\StandardTagFactory;
use Zenstruck\Foundry\Tests\Integration\RequiresORM;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class EntityFactoryRelationshipTest extends KernelTestCase
{
    use Factories, RequiresORM, ResetDatabase;

    /**
     * @test
     */
    public function many_to_one(): void
    {
        $contact = $this->contactFactory()::createOne();

        $this->contactFactory()::repository()->assert()->count(1);
        $this->categoryFactory()::repository()->assert()->count(1);

        $this->assertNotNull($contact->id);
        $this->assertNotNull($contact->getCategory()?->id);
    }

    /**
     * @test
     */
    public function disabling_persistence_cascades_to_children(): void
    {
        $contact = $this->contactFactory()->withoutPersisting()->create([
            'tags' => $this->tagFactory()->many(3),
        ]);

        $this->contactFactory()::repository()->assert()->empty();
        $this->categoryFactory()::repository()->assert()->empty();
        $this->tagFactory()::repository()->assert()->empty();
        $this->addressFactory()::repository()->assert()->empty();

        $this->assertNull($contact->id);
        $this->assertNull($contact->getCategory()?->id);
        $this->assertNull($contact->getAddress()?->id);
        $this->assertCount(3, $contact->getTags());

        foreach ($contact->getTags() as $tag) {
            $this->assertNull($tag->id);
        }

        $category = $this->categoryFactory()->withoutPersisting()->create([
            'contacts' => $this->contactFactory()->many(3),
        ]);

        $this->contactFactory()::repository()->assert()->empty();
        $this->categoryFactory()::repository()->assert()->empty();

        $this->assertNull($category->id);
        $this->assertCount(3, $category->getContacts());

        foreach ($category->getContacts() as $contact) {
            $this->assertSame($category, $contact->getCategory());
        }
    }

    /**
     * @test
     */
    public function one_to_many(): void
    {
        $category = $this->categoryFactory()::createOne([
            'contacts' => $this->contactFactory()->many(3),
        ]);

        $this->contactFactory()::repository()->assert()->count(3);
        $this->categoryFactory()::repository()->assert()->count(1);
        $this->assertNotNull($category->id);

        foreach ($category->getContacts() as $contact) {
            $this->assertSame($category->id, $contact->getCategory()?->id);
        }
    }

    /**
     * @test
     */
    public function many_to_many_owning(): void
    {
        $tag = $this->tagFactory()::createOne([
            'contacts' => $this->contactFactory()->many(3),
        ]);

        $this->contactFactory()::repository()->assert()->count(3);
        $this->tagFactory()::repository()->assert()->count(1);
        $this->assertNotNull($tag->id);

        foreach ($tag->getContacts() as $contact) {
            $this->assertSame($tag->id, $contact->getTags()[0]?->id);
        }
    }

    /**
     * @test
     */
    public function many_to_many_inverse(): void
    {
        $contact = $this->contactFactory()::createOne([
            'tags' => $this->tagFactory()->many(3),
        ]);

        $this->contactFactory()::repository()->assert()->count(1);
        $this->tagFactory()::repository()->assert()->count(3);
        $this->assertNotNull($contact->id);

        foreach ($contact->getTags() as $tag) {
            $this->assertTrue($contact->getTags()->contains($tag));
            $this->assertNotNull($tag->id);
        }
    }

    /**
     * @test
     */
    public function one_to_one_owning(): void
    {
        $contact = $this->contactFactory()::createOne();

        $this->contactFactory()::repository()->assert()->count(1);
        $this->addressFactory()::repository()->assert()->count(1);

        $this->assertNotNull($contact->id);
        $this->assertNotNull($contact->getAddress()?->id);
    }

    /**
     * @test
     */
    public function one_to_one_inverse(): void
    {
        $this->markTestIncomplete();

        //        $address = $this->addressFactory()::createOne([
        //            'contact' => $this->contactFactory(),
        //        ]);
        //
        //        $this->contactFactory()::repository()->assert()->count(1);
        //        $this->addressFactory()::repository()->assert()->count(1); // should be 1 but is 2
        //
        //        $this->assertNotNull($address->id);
        //        $this->assertSame($address->id, $address->getContact()?->getAddress()?->id);
    }

    /**
     * @return PersistentObjectFactory<Contact>
     */
    protected function contactFactory(): PersistentObjectFactory
    {
        return StandardContactFactory::new(); // @phpstan-ignore-line
    }

    /**
     * @return PersistentObjectFactory<Category>
     */
    protected function categoryFactory(): PersistentObjectFactory
    {
        return StandardCategoryFactory::new(); // @phpstan-ignore-line
    }

    /**
     * @return PersistentObjectFactory<Tag>
     */
    protected function tagFactory(): PersistentObjectFactory
    {
        return StandardTagFactory::new(); // @phpstan-ignore-line
    }

    /**
     * @return PersistentObjectFactory<Address>
     */
    protected function addressFactory(): PersistentObjectFactory
    {
        return StandardAddressFactory::new(); // @phpstan-ignore-line
    }
}
