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

use Doctrine\Persistence\ObjectRepository;
use Zenstruck\Foundry\Factory;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @template T of object
 * @implements ObjectRepository<T>
 * @implements \IteratorAggregate<int,T&Proxy>
 *
 * @phpstan-import-type Parameters from Factory
 */
final class RepositoryDecorator implements ObjectRepository, \IteratorAggregate, \Countable
{
    public function __construct(private ObjectRepository $inner)
    {
    }

    /**
     * @param Parameters $attributes
     *
     * @return T&Proxy
     */
    public function findOrCreate(array $attributes): object
    {
    }

    /**
     * @return T&Proxy
     */
    public function first(string $sortedField = 'id'): object
    {
    }

    /**
     * @return T&Proxy
     */
    public function last(string $sortedField = 'id'): object
    {
    }

    /**
     * @return (T&Proxy)[]
     */
    public function all(): array
    {
    }

    /**
     * @param Parameters $attributes
     *
     * @return (T&Proxy)[]
     */
    public function findBy(array $attributes, ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array
    {
    }

    /**
     * @param Parameters $attributes
     *
     * @return T&Proxy
     */
    public function random(array $attributes): object
    {
    }

    /**
     * @param Parameters $attributes
     *
     * @return T&Proxy
     */
    public function randomOrCreate(array $attributes): object
    {
    }

    /**
     * @param Parameters $attributes
     *
     * @return (T&Proxy)[]
     */
    public function randomSet(int $number, array $attributes = []): array
    {
    }

    /**
     * @param Parameters $attributes
     *
     * @return (T&Proxy)[]
     */
    public function randomRange(int $min, int $max, array $attributes = []): array
    {
    }

    /**
     * @param Parameters|mixed $attributes
     *
     * @return T&Proxy
     */
    public function get(mixed $attributes): object
    {
    }

    public function count(array $attributes = []): int
    {
    }

    public function truncate(): void
    {
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * @param Parameters|mixed $attributes
     *
     * @return T&Proxy
     */
    public function find(mixed $attributes): ?object
    {
        // TODO: Implement find() method.
    }

    /**
     * @return (T&Proxy)[]
     */
    public function findAll(): array
    {
        return $this->all();
    }

    /**
     * @param Parameters $attributes
     *
     * @return (T&Proxy)|null
     */
    public function findOneBy(array $attributes): ?object
    {
    }

    public function getClassName(): string
    {
        return $this->inner->getClassName();
    }
}
