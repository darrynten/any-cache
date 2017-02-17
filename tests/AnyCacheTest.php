<?php

namespace DarrynTen\AnyCache\Tests;

use PHPUnit_Framework_TestCase;
use DarrynTen\AnyCache\AnyCache;

class AnyCacheTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function has()
    {
        $cache = new AnyCache();
        $cache->put('foo', 'bar', 1);
        $this->assertTrue($cache->has('foo'));
    }

    /** @test */
    public function hasNot()
    {
        $cache = new AnyCache();
        $this->assertFalse($cache->has('foo'));
    }

    /** @test */
    public function getExistingKey()
    {
        $cache = new AnyCache();
        $cache->put('foo', 'bar', 5);
        $this->assertTrue($cache->has('foo'));
        $this->assertEquals('bar', $cache->get('foo'));
    }

    /** @test */
    public function getNonExistingKey()
    {
        $cache = new AnyCache();
        $this->assertNull($cache->get('foo'));
    }

    /** @test */
    public function pullExistingKey()
    {
        $cache = new AnyCache();
        $cache->put('foo', 'bar', 5);
        $this->assertTrue($cache->has('foo'));
        $this->assertEquals('bar', $cache->pull('foo'));
        $this->assertFalse($cache->has('foo'));
        $this->assertNull($cache->get('foo'));
    }

    /** @test */
    public function pullNonExistingKey()
    {
        $cache = new AnyCache();
        $this->assertNull($cache->pull('foo'));
    }

    /** @test */
    public function pullNonExistingKeyWithDefaultValue()
    {
        $cache = new AnyCache();
        $this->assertEquals('bar', $cache->pull('foo', 'bar'));
    }

    public function testException()
    {
        // $this->expectException(\Exception::class);

        // Not working... How to throw?
    }
}
