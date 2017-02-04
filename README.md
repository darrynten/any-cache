## any-cache

Adapter designed to add Framework Agnosticism for Caching within PHP Packages.

### Goal

Allow package developers to use whichever caching mechanisms are native to whichever framework it is 
installed in via a simple interface.

### Supported Interfaces

- [ ] Laravel
- [ ] Temporary Array (default)
- [ ] Symfony
- [ ] Psr6
- [ ] ...

### Supported Cache Calls

- [ ] get ($key, $default)
- [ ] set ($key, $value, $time)
- [ ] forever ($key, $value)
- [ ] has ($key)
- [ ] pull ($key)
- [ ] ...

### Provides

`$cache = new AnyCache()`
`$this->cache()->get($key, $default)` etc

### Details

Package creators accept a cache config variable and boot up the desired cache interface.

Application developers can include the package and optionally configure it to use native framework 
caching.

If none is provided then a local temporary `ArrayCache` is created and will be used by default, and 
exposed via the same mechanisms. This is transient and not persistent.

This allows you to not have any additional caching requirements in your packages while allowing you 
to leverage whichever caching constructs are already in place.

#### Acknowledgments

* https://github.com/mpociot/botman project for the original idea and implementation
* https://github.com/neeilya
* add yourself here ...
