<?php

namespace DarrynTen\AnyCache;

use DarrynTen\AnyCache\Adapter\Factory;

/**
 * The main entry point of he AnyCache module.
 *
 * Exposes an uniform API for access to the active caching adapter
 */
class Cache implements CacheInterface
{
    /**
     * @var CacheInterface
     */
    private $adapter;

    /**
     * Constructs the cache facade and invokes the factory to instantiate the actual cache.
     *
     * @param mixed|null $artifact A framework specific artifact to be used for to get access to it's cache, e.g. registry, service container, etc
     * @param Factory    $factory  Optional. The cache adapter factory to be used - defaults to the one provided with the module
     */
    public function __construct($artifact = null, Factory $factory = null)
    {
        if ($factory === null) {
            $factory = new Factory();
        }

        try {
            $this->adapter = $artifact !== null ? $factory->createByArtifact($artifact) : $factory->createByContext();
        } catch (\Exception $exception) {
            // ignore all errors an just fallback to the default adapter
        }

        if ($this->adapter === null) {
            $this->adapter = $factory->createDefaultAdapter();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        return $this->adapter->has($key);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        return $this->adapter->get($key, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function pull($key, $default = null)
    {
        return $this->adapter->pull($key, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function put($key, $value, $minutes)
    {
        $this->adapter->put($key, $value, $minutes);
    }
}
