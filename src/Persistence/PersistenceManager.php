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

use DAMA\DoctrineTestBundle\Doctrine\DBAL\StaticDriver;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @internal
 */
abstract class PersistenceManager
{
    public static bool $ormOnly = false;

    /**
     * @param array<string,mixed> $config
     */
    public function __construct(protected readonly ManagerRegistry $registry, protected readonly array $config)
    {
    }

    final public static function isDAMADoctrineTestBundleEnabled(): bool
    {
        return \class_exists(StaticDriver::class) && StaticDriver::isKeepStaticConnections();
    }

    public function autoPersist(): bool
    {
        return $this->config['auto_persist'];
    }

    /**
     * @param class-string $class
     */
    public function supports(string $class): bool
    {
        return (bool) $this->registry->getManagerForClass($class);
    }

    /**
     * @template T of object
     *
     * @param T $object
     *
     * @return T
     */
    public function save(object $object): object
    {
        $om = $this->objectManagerFor($object::class);
        $om->persist($object);
        $om->flush();

        return $object;
    }

    /**
     * @template T of object
     *
     * @param T $object
     *
     * @return T
     */
    public function refresh(object &$object): object
    {
        if ($this->hasChanges($object)) {
            throw new \RuntimeException(\sprintf('Cannot auto refresh "%s" as there are unsaved changes. Be sure to call ->_save() or disable auto refreshing (see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#auto-refresh for details).', $object::class));
        }

        $om = $this->objectManagerFor($object::class);

        if ($om->contains($object)) {
            $om->refresh($object);

            return $object;
        }

        $id = $om->getClassMetadata($object::class)->getIdentifierValues($object);

        if (!$id || !$object = $om->find($object::class, $id)) {
            throw new \RuntimeException('object no longer exists...');
        }

        return $object;
    }

    /**
     * @template T of object
     *
     * @param T $object
     *
     * @return T
     */
    public function delete(object $object): object
    {
        $om = $this->objectManagerFor($object::class);
        $om->remove($object);
        $om->flush();

        return $object;
    }

    /**
     * @param class-string $class
     */
    public function objectManagerFor(string $class): ObjectManager
    {
        return $this->registry->getManagerForClass($class) ?? throw new \LogicException(\sprintf('No manager found for "%s".', $class));
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return RepositoryDecorator<T>
     */
    public function repositoryFor(string $class): RepositoryDecorator
    {
        return new RepositoryDecorator($class);
    }

    abstract public function hasChanges(object $object): bool;

    abstract public function resetDatabase(KernelInterface $kernel): void;

    abstract public function resetSchema(KernelInterface $kernel): void;

    /**
     * @param array<string,scalar> $parameters
     */
    final protected static function runCommand(Application $application, string $command, array $parameters = [], bool $canFail = false): void
    {
        $exit = $application->run(
            new ArrayInput(\array_merge(['command' => $command], $parameters)),
            $output = new BufferedOutput()
        );

        if (0 !== $exit && !$canFail) {
            throw new \RuntimeException(\sprintf('Error running "%s": %s', $command, $output->fetch()));
        }
    }

    final protected static function application(KernelInterface $kernel): Application
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        return $application;
    }
}