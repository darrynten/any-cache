<?php

namespace DarrynTen\AnyCache\Adapter;

use DarrynTen\AnyCache\CacheInterface;

use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Store;

/**
 * The Laravel Cache implementation.
 *
 * Since the Laravel Cache uses closures, it cannot be serialized,
 * that's why we use the facade.
 *
 * This is also why the tests for this class are somewhat incomplete,
 * as I have not been able to mock the facade yet.
 *
 * @package AnyCache
 */
class LaravelCache implements CacheInterface
{
    /**
     * The CacheManager instance
     *
     * @var CacheManager|Store
     */
    private $_cacheManager;

    /**
     * Constructor
     *
     * @param CacheManager $cacheManager The Laravel CacheManager
     */
    public function __construct(CacheManager $cacheManager)
    {
        $this->_cacheManager = $cacheManager;
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
        return $this->_cacheManager->has($key);
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
        return $this->_cacheManager->get($key, $default);
    }

    /**
     * Retrieve an item from the cache and delete it.
     *
     * @param string $key     The cache key
     * @param mixed  $default The default value
     *
     * @return mixed
     */
    public function pull($key, $default = null)
    {
        return $this->_cacheManager->pull($key, $default);
    }

    /**
     * Store an item in the cache.
     *
     * @param string        $key     The cache key
     * @param mixed         $value   The value
     * @param \DateTime|int $minutes The cache time in minutes
     *
     * @return void
     */
    public function put($key, $value, $minutes)
    {
        $this->_cacheManager->put($key, $value, $minutes);
    }
}
