<?php

declare(strict_types=1);

namespace Consul\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection;

class ConsulExtension extends DependencyInjection\Extension\Extension
{
    /**
     * Load bundle configuration
     *
     * @param mixed[]                              $configs   Configuration.
     * @param DependencyInjection\ContainerBuilder $container Container.
     *
     * @throws \Throwable
     *
     * @return void
     */
    public function load(array $configs, DependencyInjection\ContainerBuilder $container): void
    {
        $loader = new DependencyInjection\Loader\PhpFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../config')
        );

        $loader->load('services.php');
    }
}
