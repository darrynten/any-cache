<?php

namespace DarrynTen\AnyCache\Adapter;

use DarrynTen\AnyCache\CacheInterface;

use Psr\Cache\CacheItemPoolInterface;
use Doctrine\Common\Cache\Cache;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Foundation\Application;

/**
 * Cache adapter factory.
 */
class Factory
{
    /**
     * Tries to create the appropriate adapter by inspecting the context.
     *
     * Insects the global namespace for known framework bootstrapers and tries to retrieve their default caching facility
     *
     * @return CacheInterface|null
     */
    public function createByContext()
    {
        /*
         * Symfony - search for a kernel and use it's container
         */
        if (isset($GLOBALS['kernel'])
            && interface_exists('\Symfony\Component\HttpKernel\KernelInterface')
            && $GLOBALS['kernel'] instanceof KernelInterface
        ) {
            return $this->createSymfonyAdapter($GLOBALS['kernel']->getContainer());
        }

        /*
         * Laravel - search for an application instance
         */
        if (isset($GLOBALS['app'])
            && interface_exists('\Illuminate\Contracts\Foundation\Application')
            && $GLOBALS['app'] instanceof Application
        ) {
            return $this->createLaravelAdapter($GLOBALS['app']);
        }
    }

    /**
     * Tries to create an adapter based on the provided artifact.
     *
     * @param mixed $object
     *
     * @return CacheInterface|null
     */
    public function createByArtifact($object)
    {
        // failsafe
        if ($object instanceof CacheInterface) {
            return $object;
        }

        foreach ($this->getFactoryQueue() as $factory) {
            if (($adapter = $factory($object)) !== null) {
                return $adapter;
            }
        }
    }

    /**
     * Returns an adapter instance using the default cache type.
     *
     * @return CacheInterface
     */
    public function createDefaultAdapter()
    {
        return new ArrayCache();
    }

    /**
     * Creates a SymfonyCache adapter using either a cache instance or a service container instance.
     *
     * @param AdapterInterface|ContainerInterface|mixed $object
     *
     * @return SymfonyCache|null
     */
    public function createSymfonyAdapter($object)
    {
        if (!interface_exists('\Symfony\Component\Cache\Adapter\AdapterInterface')) {
            return null;
        }

        if ($object instanceof AdapterInterface) {
            return new SymfonyCache($object);
        }

        if (interface_exists('\Symfony\Component\DependencyInjection\ContainerInterface')
            && $object instanceof ContainerInterface
            && $object->has('cache.app')
            && $object->get('cache.app') instanceof AdapterInterface
        ) {
            return new SymfonyCache($object->get('cache.app'));
        }
    }

    /**
     * Creates a LaravelCache adapter using either a cache instance or a service container instance.
     *
     * @param CacheManager|Container|mixed $object
     *
     * @return LaravelCache|null
     */
    public function createLaravelAdapter($object)
    {
        if (!class_exists('\Illuminate\Cache\CacheManager')) {
            return null;
        }

        if ($object instanceof CacheManager) {
            return new LaravelCache($object);
        }

        if (interface_exists('\Illuminate\Contracts\Container\Container')
            && $object instanceof Container
            && ($laraCache = $object->make('cache')) instanceof CacheManager
        ) {
            return new LaravelCache($laraCache);
        }
    }

    /**
     * Creates a DoctrineCache using a driver instance.
     *
     * @param Cache|mixed $object
     *
     * @return DoctrineCache|null
     */
    public function createDoctrineAdapter($object)
    {
        if (!interface_exists('\Doctrine\Common\Cache\Cache')) {
            return null;
        }

        if ($object instanceof Cache) {
            return new DoctrineCache($object);
        }
    }

    /**
     * Creates a PSR-6 adapter for a compatible instance.
     *
     * @param CacheItemPoolInterface|mixed $object
     *
     * @return Psr6Cache|null
     */
    public function createPsr6Adapter($object)
    {
        if (!interface_exists('\Psr\Cache\CacheItemPoolInterface')) {
            return null;
        }

        if ($object instanceof CacheItemPoolInterface) {
            return new Psr6Cache($object);
        }
    }

    /**
     * Returns a queue of factory methods ordered by priority.
     *
     * @return callable[]
     */
    protected function getFactoryQueue()
    {
        return [
            [$this, 'createSymfonyAdapter'],
            [$this, 'createLaravelAdapter'],
            [$this, 'createDoctrineAdapter'],
            [$this, 'createPsr6Adapter'],
        ];
    }
}
