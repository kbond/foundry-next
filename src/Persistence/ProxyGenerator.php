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

use Symfony\Component\VarExporter\LazyObjectInterface;
use Symfony\Component\VarExporter\ProxyHelper;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @internal
 */
final class ProxyGenerator
{
    private function __construct()
    {
    }

    /**
     * @template T of object
     *
     * @param T $object
     *
     * @return T&Proxy<T>
     */
    public static function create(object $object): Proxy
    {
        return self::generateClassFor($object)::createLazyProxy(static fn() => $object); // @phpstan-ignore-line
    }

    /**
     * @template T
     *
     * @param T $what
     *
     * @return T
     */
    public static function unwrap(mixed $what): mixed
    {
        if (\is_array($what)) {
            return \array_map(self::unwrap(...), $what); // @phpstan-ignore-line
        }

        if (\is_object($what)) {
            return $what instanceof Proxy ? $what->_real() : $what; // @phpstan-ignore-line
        }

        if (\is_string($what) && \is_a($what, Proxy::class, true)) {
            return \get_parent_class($what) ?: throw new \LogicException('Proxy class must have a parent class.'); // @phpstan-ignore-line
        }

        return $what;
    }

    /**
     * @template T of object
     *
     * @param T $object
     *
     * @return class-string<LazyObjectInterface&Proxy<T>&T>
     */
    private static function generateClassFor(object $object): string
    {
        $proxyClass = \str_replace('\\', '', $object::class).'Proxy';

        /** @var class-string<LazyObjectInterface&Proxy<T>&T> $proxyClass */
        if (\class_exists($proxyClass)) {
            return $proxyClass;
        }

        $proxyCode = 'class '.$proxyClass.ProxyHelper::generateLazyProxy(new \ReflectionClass($object::class));
        $proxyCode = \str_replace(
            [
                'implements \Symfony\Component\VarExporter\LazyObjectInterface',
                'use \Symfony\Component\VarExporter\LazyProxyTrait;',
                'if (isset($this->lazyObjectState)) {',
            ],
            [
                \sprintf('implements \%s, \Symfony\Component\VarExporter\LazyObjectInterface', Proxy::class),
                \sprintf('use \\%s, \\Symfony\\Component\\VarExporter\\LazyProxyTrait;', IsProxy::class),
                "\$this->_autoRefresh();\n\n        if (isset(\$this->lazyObjectReal)) {",
            ],
            $proxyCode
        );

        eval($proxyCode);

        return $proxyClass;
    }
}
