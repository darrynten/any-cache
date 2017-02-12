<?php

namespace DarrynTen\AnyCache\Tests;

use PHPUnit_Framework_TestCase;
use DarrynTen\AnyCache\AnyCache;

use Psr\Cache\CacheItemPoolInterface;
use Doctrine\Common\Cache\Cache;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Foundation\Application;

class FactoryTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function testArtifact()
    {
        $cache = new AnyCache(\Doctrine\Common\Cache\Cache::class);

        $this->assertInstanceOf(AnyCache::class, $cache);
    }

    /** @test */
    public function testPsr()
    {
        $cache = new AnyCache(Psr\Cache\CacheItemPoolInterface::class);

        $this->assertInstanceOf(AnyCache::class, $cache);
    }

    public function testException()
    {
        // $this->expectException(\Exception::class);

        // Not working... How to throw?
    }
}
