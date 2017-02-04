## any-cache

Adapter designed to add Framework Agnosticism for Caching within PHP Packages.

### Goal

Allow package developers to leverage whichever caching mechanisms are native to whichever framework it is installed in.

### Supported Interfaces

- [ ] Laravel
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

`->cache()` etc

#### Acknowledgments

* https://github.com/mpociot/botman project for the original idea and implementation
* https://github.com/neeilya
* add yourself here ...
