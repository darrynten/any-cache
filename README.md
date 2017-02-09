## any-cache

Adapter designed to add Framework Agnosticism for Caching within PHP Packages.

Supports PHP 5.6+

### Install

```bash
composer require darrynten/any-cache
```

### Goal

Allow package developers to use whichever caching mechanisms are native
to whichever framework it is installed in via a simple interface.

Can be passed an artifact, but can also autodetect its host framework.

Passing in takes precedence and allows developers to use a specific
framework but with a totally different cache library or configuration.

### Details

Package creators can include `AnyCache` in their packages and leverage
supported host framework native caching capabilities.

`AnyCache` auto-detects its host framework and does not require any
extra configuration, although it also allows passing in a desired cache.

If none is provided or if there is no caching available, then a local
temporary `ArrayCache` is created and will be used by default. This is
transient and not persistent.

This allows you to not have any additional caching requirements in your
packages while allowing you  to leverage whichever caching constructs 
are already in place.

### Supported Frameworks

- [x] Temporary Array (default)
- [x] Laravel
- [x] Symfony
- [x] Doctrine
- [x] Psr6
- [ ] CodeIgniter (partially complete)
- [ ] ...

### Supported Cache Calls

- [x] get ($key, $default)
- [x] set ($key, $value, $time)
- [x] has ($key)
- [x] pull ($key)
- [ ] forever ($key, $value)
- [ ] ...

### Provides

Create a new instance.

```php
use DarrynTen\AnyCache;

$this->cache = new AnyCache()
```

Call

```php
$key = 'foo';
$value = 'bar';
$time = 60;

// Set a value
$this->cache()->set($key, $value, $time);

// Get a cached value
$result = $this->cache()->get($key);

// Check if a key exists
if ($this->cache->has($key)) {
  //
}

// Get and unset
$result = $this->cache()->pull($key);
```

### Notes

The CodeIgniter support is not complete, and it does not auto-detect
this framework at this time.

### Missing Tests

The Laravel tests are not 100% complete, there is an issue with
testing the Cache Facade on the `get` method.

The factory does not have unit test coverage at this point in time.

The main class is also not tested yet.

#### Acknowledgments

* [Marcel Pociot](https://github.com/mpociot) and his [Botman Project](https://github.com/mpociot/botman)
for the original idea and implementation.
* [Alexander Marinov](https://github.com/ssaki) for his amazing skills.


