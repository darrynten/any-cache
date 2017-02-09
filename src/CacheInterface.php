<?php

namespace DarrynTen\AnyCache;

interface CacheInterface
{
    /**
     * Determine if an item exists in the cache.
     *
     * @param string $key The cache key
     *
     * @return bool
     */
    public function has($key);

    /**
     * Retrieve an item from the cache by key.
     *
     * @param string $key     The cache key
     * @param mixed  $default The default value (optional)
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Retrieve an item from the cache and delete it.
     *
     * @param string $key     The cache key
     * @param mixed  $default The default value (optional)
     *
     * @return mixed
     */
    public function pull($key, $default = null);

    /**
     * Store an item in the cache.
     *
     * @param string        $key     The cache key
     * @param mixed         $value   The value to cache
     * @param \DateTime|int $minutes The time to cache for
     *
     * @return void
     */
    public function put($key, $value, $minutes);
}
