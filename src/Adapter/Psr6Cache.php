<?php

namespace DarrynTen\AnyCache\Adapter;

use Psr\Cache\CacheItemPoolInterface;
use DarrynTen\AnyCache\CacheInterface;

class Psr6Cache implements CacheInterface
{
    /**
     * The PSR cache instance
     *
     * @var CacheItemPoolInterface
     */
    protected $adapter;

    /**
     * Construct
     *
     * @param CacheItemPoolInterface $adapter The PsrCache
     */
    public function __construct(CacheItemPoolInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Check if has the requested key
     *
     * @param string $key The cache key
     *
     * @return bool
     */
    public function has($key)
    {
        return $this->adapter->hasItem($key);
    }

    /**
     * Get the cached item
     *
     * @param string $key     The cache key
     * @param null   $default The default value (optional)
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        $item = $this->adapter->getItem($key);
        if ($item->isHit()) {
            return $item->get();
        }

        return $default;
    }

    /**
     * Pull from the cache
     *
     * @param string $key     The cache key
     * @param null   $default The default value (optional)
     *
     * @return null
     */
    public function pull($key, $default = null)
    {
        $item = $this->adapter->getItem($key);
        if ($item->isHit()) {
            $this->adapter->deleteItem($key);

            return $item->get();
        }

        return $default;
    }

    /**
     * Put into the cache
     *
     * @param string        $key     The cache key
     * @param mixed         $value   The item to be cached
     * @param \DateTime|int $minutes The cache time in minutes
     *
     * @return void
     */
    public function put($key, $value, $minutes)
    {
        $item = $this->adapter->getItem($key);
        $item->set($value);

        if ($minutes instanceof \DateTimeInterface) {
            $item->expiresAt($minutes);
        } else {
            $item->expiresAfter(new \DateInterval(sprintf('PT%dM', $minutes)));
        }

        $this->adapter->save($item);
    }
}
