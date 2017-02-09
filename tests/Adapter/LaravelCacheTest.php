<?php
// https://github.com/laravel/framework/issues/9729

namespace DarrynTen\AnyCache\Tests\Adapter;

use Mockery as m;
use PHPUnit_Framework_TestCase;
use DarrynTen\AnyCache\Adapter\LaravelCache;
use Illuminate\Cache\CacheManager;
use Illuminate\Cache\Repository;
use Illuminate\Contracts\Cache\Store;

class LaravelCacheTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    /** @test */
    public function has()
    {
        $driver = m::mock(CacheManager::class);
        $driver->shouldReceive('has')->once()->andReturn(true);

        $cache = new LaravelCache($driver);
        $this->assertTrue($cache->has('foo'));
    }

    /** @test */
    public function has_not()
    {
        $driver = m::mock(CacheManager::class);
        $driver->shouldReceive('has')->once()->andReturn(false);

        $cache = new LaravelCache($driver);
        $this->assertFalse($cache->has('foo'));
    }

    /** @test */
    public function get_existing_key()
    {

        // $item->shouldReceive('get')->once()->andReturn('bar');
        //
        // $driver = m::mock(CacheManager::class);
        // $driver->shouldReceive('get')->once()->andReturn($item);
        //
        // $cache = new LaravelCache($driver);
        // $this->assertEquals('bar', $cache->get('foo', null));
    }

    /** @test */
    public function get_non_existing_key()
    {
        // $item = m::mock(CacheItemInterface::class);
        // $item->shouldReceive('has')->once()->andReturn(false);
        //
        // $driver = m::mock(CacheManager::class);
        // $driver->shouldReceive('get')->once()->andReturn($item);
        //
        // $cache = new LaravelCache($driver);
        // $this->assertNull($cache->get('foo', null));
    }

    /** @test */
    public function pull_existing_key()
    {
        // $item = m::mock(CacheItemInterface::class);
        // $item->shouldReceive('has')->once()->andReturn(true);
        // $item->shouldReceive('get')->once()->andReturn('bar');
        //
        // $driver = m::mock(CacheManager::class);
        // $driver->shouldReceive('get')->once()->andReturn($item);
        // $driver->shouldReceive('delete')->once();
        //
        // $cache = new LaravelCache($driver);
        // $this->assertEquals('bar', $cache->pull('foo', null));
    }

    /** @test */
    public function pull_non_existing_key()
    {

        //
        // $driver = m::mock(CacheManager::class);
        // $driver->shouldReceive('get')->once()->andReturn($item);
        //
        // $cache = new LaravelCache($driver);
        // $this->assertNull($cache->pull('foo', null));
    }

    /** @test */
    public function pull_non_existing_key_with_default_value()
    {
        // $item = m::mock(CacheItemInterface::class);
        // $item->shouldReceive('has')->once()->andReturn(false);

        // $driver = m::mock(CacheManager::class);
        // $driver->shouldReceive('get')->once()->andReturn($item);

        // $cache = new LaravelCache($driver);
        // $this->assertEquals('bar', $cache->pull('foo', 'bar'));
    }

    /** @test */
    public function put()
    {
        // $item = m::mock(CacheItemInterface::class);
        // $item->shouldReceive('put')->once()->withArgs(['bar']);
        //
        // $driver = m::mock(CacheManager::class);
        // $driver->shouldReceive('get')->once()->withArgs(['foo'])->andReturn($item);
        // $driver->shouldReceive('put')->once();
        //
        // $cache = new LaravelCache($driver);
        // $cache->put('foo', 'bar', 5);
    }

    /** @test */
    public function put_with_datetime()
    {
        // $item = m::mock(CacheItemInterface::class);
        // $item->shouldReceive('put')->once()->withArgs(['bar']);
        //
        // $driver = m::mock(CacheManager::class);
        // $driver->shouldReceive('get')->once()->withArgs(['foo'])->andReturn($item);
        // $driver->shouldReceive('put')->once();
        //
        // $cache = new LaravelCache($driver);
        // $cache->put('foo', 'bar', new \DateTime('+5 minutes'));
    }
}
