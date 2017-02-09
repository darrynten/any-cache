<?php

namespace DarrynTen\AnyCache\Adapter;

use DarrynTen\AnyCache\CacheInterface;

use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Store;

/**
 * The Laravel Cache implementation.
 * Since the Laravel Cache uses closures, it cannot be serialized,
 * that's why I'm using the facade in here.
 */
class LaravelCache implements CacheInterface
{
    /**
     * @var CacheManager|Store
     */
    private $cacheManager;

    /**
     * Constructor
     *
     * @param CacheManager $cacheManager
     */
    public function __construct(CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    /**
     * Determine if an item exists in the cache.
     *
     * @param  string $key
     * @return bool
     */
    public function has($key)
    {
        return $this->cacheManager->has($key);
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->cacheManager->get($key, $default);
    }

    /**
     * Retrieve an item from the cache and delete it.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    public function pull($key, $default = null)
    {
        return $this->cacheManager->pull($key, $default);
    }

    /**
     * Store an item in the cache.
     *
     * @param  string $key
     * @param  mixed $value
     * @param  \DateTime|int $minutes
     * @return void
     */
    public function put($key, $value, $minutes)
    {
        $this->cacheManager->put($key, $value, $minutes);
    }
}
