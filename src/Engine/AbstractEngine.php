<?php

declare(strict_types=1);

namespace Consul\Engine;

use Consul\API\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractEngine implements AbstractEngineInterface
{
    protected string $apiVersion;

    protected string $appDirectory;

    /**
     * AbstractEngine constructor
     *
     * @param ContainerInterface     $container Container instance.
     * @param Client\ClientInterface $client    ConsulAPI Client instance.
     *
     * @psalm-suppress PossiblyInvalidCast
     */
    public function __construct(
        protected ContainerInterface $container,
        protected Client\ClientInterface $client
    ) {
        $this->apiVersion   = (string)$this->container->getParameter('consul.api_version');
        $appName            = (string)$this->container->getParameter('app.name');
        $appEnvironment     = (string)$this->container->getParameter('kernel.environment');
        $this->appDirectory = "{$appName}/{$appEnvironment}";
    }

    /**
     * Resolve request opetions
     *
     * @param array $options          Passed options.
     * @param array $availableOptions Available options.
     * @param array $defaultOptions   Default options.
     *
     * @return array
     */
    protected function resolveOptions(
        array $options,
        array $availableOptions,
        array $defaultOptions = [],
    ): array {
        return array_replace($defaultOptions, array_intersect_key($options, array_flip($availableOptions)));
    }
}
