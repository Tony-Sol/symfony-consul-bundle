<?php

declare(strict_types=1);

namespace Consul\Engine\Health;

use Consul\Engine\AbstractEngine;
use Consul\API\Response\ConsulResponseInterface;

// phpcs:disable Squiz.Arrays.ArrayDeclaration.SingleLineNotAllowed
final class Health extends AbstractEngine implements HealthInterface
{
    /**
     * {@inheritdoc}
     *
     * @param string               $node    Health node.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function node(string $node, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/health/node/{$node}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $service Health service.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function checks(string $service, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/health/checks/{$service}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $service Health service.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function service(string $service, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc', 'tag', 'passing'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/health/service/{$service}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $state   Health state.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function state(string $state, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/health/state/{$state}", $params);
    }
}
// phpcs:enable
