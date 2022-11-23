<?php

declare(strict_types=1);

namespace Consul;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $container
        ->parameters()
        ->set('app.name', '%env(resolve:APP_NAME)%')
        ->set('consul.base_uri', '%env(resolve:CONSUL_HTTP_ADDRESS)%')
        ->set('consul.timeout', '%env(resolve:CONSUL_TIMEOUT)%')
        ->set('consul.api_version', '%env(resolve:CONSUL_API_VERSION)%')
    ;
    $services = $container
        ->services()
            ->defaults()
                ->autoconfigure(true)
                ->autowire(true)
    ;
    $services
        ->load(__NAMESPACE__ . '\\', '../src/*')
        ->exclude(['../src/DependencyInjection'])
    ;
};
