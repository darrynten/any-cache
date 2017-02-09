<?php
/**
 * This is not fully implemented yet
 *
 * Feel free to make it happen :)
 */

namespace DarrynTen\AnyCache\Adapter;

use DarrynTen\AnyCache\CacheInterface;

class CodeIgniterCache implements CacheInterface
{
    /**
     * The cache
     *
     * @var object $_cache The cache object
     */
    private $_cache;

    /**
     * Constructor
     *
     * @param array $driver The CI cache driver
     */
    public function __construct($driver)
    {
        $this->_cache = $driver;
    }

    /**
     * Determine if an item exists in the cache.
     *
     * @param string $key The cache key
     *
     * @return bool
     */
    public function has($key)
    {
        return $this->_cache->get($key) !== false;
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
        if ($this->has($key)) {
            return $this->_cache->get($key);
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
        if ($this->has($key)) {
            $cached = $this->_cache->get($key);
            $this->_cache->delete($key);

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
        if ($minutes instanceof \Datetime) {
            $seconds = $minutes->getTimestamp() - time();
        } else {
            $seconds = $minutes * 60;
        }

        $this->_cache->save($key, $value, $seconds);
    }
}
