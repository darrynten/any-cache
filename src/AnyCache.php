<?php
/**
 * Allows framework-agnostic caching that leverages the host frameworks cache.
 *
 * Supports auto-detection, as well as passing in a cache instance.
 *
 * @category Library
 * @package  AnyCache
 * @author   Alexander Marinov <ssaki@github.com>
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/any-cache/LICENSE>
 * @link     https://github.com/darrynten/any-cache
 */

namespace DarrynTen\AnyCache;

use DarrynTen\AnyCache\Adapter\Factory;

/**
 * The main entry point of the AnyCache module.
 *
 * Exposes an uniform API for access to the active caching adapter
 *
 * @category Interface
 * @package  AnyCache
 * @author   Alexander Marinov <ssaki@github.com>
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/any-cache/LICENSE>
 * @link     https://github.com/darrynten/any-cache
 */
class AnyCache implements CacheInterface
{
    /**
     * The cache adapter
     *
     * @var CacheInterface $_adapter
     */
    private $_adapter;

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
            $this->_adapter = $artifact !== null ? $factory->createByArtifact($artifact) : $factory->createByContext();
        } catch (\Exception $exception) {
            // ignore all errors an just fallback to the default adapter
        }

        if ($this->_adapter === null) {
            $this->_adapter = $factory->createDefaultAdapter();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        return $this->_adapter->has($key);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        return $this->_adapter->get($key, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function pull($key, $default = null)
    {
        return $this->_adapter->pull($key, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function put($key, $value, $minutes)
    {
        $this->_adapter->put($key, $value, $minutes);
    }
}
