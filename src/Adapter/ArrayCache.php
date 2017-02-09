<?php

namespace DarrynTen\AnyCache\Adapter;

use DarrynTen\AnyCache\CacheInterface;

class ArrayCache implements CacheInterface
{
    /**
     * A simple array of cached values
     *
     * @var array $_cache The array cache
     */
    private $_cache = [];

    /**
     * Determine if an item exists in the cache.
     *
     * @param string $key The cache key
     *
     * @return bool
     */
    public function has($key)
    {
        return isset($this->_cache[$key]);
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @param string $key     The cache key
     * @param mixed  $default The default value (optional)
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (isset($this->_cache[$key])) {
            return $this->_cache[$key];
        }

        return $default;
    }

    /**
     * Retrieve an item from the cache and delete it.
     *
     * @param string $key     The cache key
     * @param mixed  $default The default value (optional)
     *
     * @return mixed
     */
    public function pull($key, $default = null)
    {
        if (isset($this->_cache[$key])) {
            $cached = $this->_cache[$key];
            unset($this->_cache[$key]);

            return $cached;
        }

        return $default;
    }

    /**
     * Store an item in the cache.
     *
     * @param string        $key     The cache key
     * @param mixed         $value   The value to cache
     * @param \DateTime|int $minutes The cache time in minutes
     *
     * @return void
     */
    public function put($key, $value, $minutes)
    {
        $this->_cache[$key] = $value;
    }
}
