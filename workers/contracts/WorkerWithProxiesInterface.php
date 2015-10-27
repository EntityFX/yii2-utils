<?php

namespace entityfx\utils\workers\contracts;

use entityfx\utils\webService\clientProxies\WebClientProxyInterface;
use Traversable;

interface WorkerWithProxiesInterface {
    /**
     * @return WebClientProxyInterface[]|Traversable
     */
    public function getWebClientProxyList();

    public function setWebClientProxyList(array $proxyList);
}