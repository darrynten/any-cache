<?php

namespace DarrynTen\AnyCache\Adapter;

use Symfony\Component\Cache\Adapter\AdapterInterface;

class SymfonyCache extends Psr6Cache
{
    /**
     * Sinple
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
}
