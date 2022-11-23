<?php

declare(strict_types=1);

namespace Consul;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ConsulBundle extends Bundle
{
    /**
     * Get Consul Bundle path
     *
     * @return string
     */
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
