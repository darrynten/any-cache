<?php

namespace DarrynTen\AnyCache;

use DarrynTen\AnyCache\Adapter\ArrayCache;

class Cache implements CacheInterface
{
    /**
     * @var CacheInterface
     */
    private $adapter;

    public function __construct($config = null)
    {
        // That's just a placeholder for previewing the module
        // all the detection must be performed here or in a factory to guess the best adapter
        // leaving hardcoded the fallback for now

        $this->adapter = new ArrayCache();
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        return $this->adapter->has($key);
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        return $this->adapter->get($key, $default);
    }

    /**
     * @inheritDoc
     */
    public function pull($key, $default = null)
    {
        return $this->adapter->pull($key, $default);
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value, $minutes)
    {
        $this->adapter->put($key, $value, $minutes);
    }
}