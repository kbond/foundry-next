<?php

use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

use function PHPStan\Testing\assertType;

class User
{
    public string $name;
}

/**
 * The following method stubs are required for auto-completion in PhpStorm.
 *
 * @extends PersistentObjectFactory<User>
 *
 * @method User create(array|callable $attributes = [])
 */
final class UserFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return User::class;
    }

    protected function defaults(): array|callable
    {
        return [];
    }
}

// test autocomplete with phpstorm
assertType('string', UserFactory::new()->create()->name);
assertType('string', UserFactory::createOne()->name);
assertType('string', UserFactory::new()->many(2)->create()[0]->name);
assertType('string', UserFactory::createMany(1)[0]->name);
assertType('string', UserFactory::first()->name);
assertType('string', UserFactory::last()->name);
assertType('string', UserFactory::find(1)->name);
assertType('string', UserFactory::all()[0]->name);
assertType('string', UserFactory::random()->name);
assertType('string', UserFactory::randomRange(1, 2)[0]->name);
assertType('string', UserFactory::randomSet(2)[0]->name);
assertType('string', UserFactory::findBy(['name' => 'foo'])[0]->name);
assertType('string', UserFactory::findOrCreate([])->name);
assertType('string', UserFactory::randomOrCreate([])->name);
assertType('string|null', UserFactory::repository()->find(1)?->name);
assertType('string', UserFactory::repository()->findAll()[0]->name);


