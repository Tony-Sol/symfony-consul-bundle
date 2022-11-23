<?php

declare(strict_types=1);

namespace Consul\Engine\Catalog;

use Consul\Engine\AbstractEngine;
use Consul\API\Response\ConsulResponseInterface;

// phpcs:disable Squiz.Arrays.ArrayDeclaration.SingleLineNotAllowed
final class Catalog extends AbstractEngine implements CatalogInterface
{
    /**
     * {@inheritdoc}
     *
     * @param string $node Catalog node.
     *
     * @return ConsulResponseInterface
     */
    public function register(string $node): ConsulResponseInterface
    {
        $params = ['body' => $node];
        return $this->client->put("/{$this->apiVersion}/catalog/register", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $node Catalog node.
     *
     * @return ConsulResponseInterface
     */
    public function deRegister(string $node): ConsulResponseInterface
    {
        $params = ['body' => $node];
        return $this->client->put("/{$this->apiVersion}/catalog/deregister", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @return ConsulResponseInterface
     */
    public function dataCenters(): ConsulResponseInterface
    {
        return $this->client->get("/{$this->apiVersion}/catalog/datacenters");
    }

    /**
     * {@inheritdoc}
     *
     * @param array $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function nodes(array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/catalog/nodes", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $node    Catalog node.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function node(string $node, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/catalog/node/{$node}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param array $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function services(array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/catalog/services", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $service Catalog service.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function service(string $service, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc', 'tag'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/catalog/service/{$service}", $params);
    }
}
// phpcs:enable
