<?php

declare(strict_types=1);

namespace Consul\Engine\Session;

use Consul\Engine\AbstractEngine;
use Consul\API\Response\ConsulResponseInterface;

final class Session extends AbstractEngine implements SessionInterface
{
    /**
     * {@inheritdoc}
     *
     * @param mixed                $body    Session body.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function create(mixed $body = null, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'body'  => $body,
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->put("/{$this->apiVersion}/session/create", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $sessionId Session ID.
     * @param array<string, mixed> $options   Request options.
     *
     * @return ConsulResponseInterface
     */
    public function destroy(string $sessionId, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->put("/{$this->apiVersion}/session/destroy/{$sessionId}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $sessionId Session ID.
     * @param array<string, mixed> $options   Request options.
     *
     * @return ConsulResponseInterface
     */
    public function info(string $sessionId, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/session/info/{$sessionId}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $node    Session node.
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
        return $this->client->get("/{$this->apiVersion}/session/node/{$node}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function list(array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/session/list", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $sessionId Session ID.
     * @param array<string, mixed> $options   Request options.
     *
     * @return ConsulResponseInterface
     */
    public function renew(string $sessionId, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->put("/{$this->apiVersion}/session/renew/{$sessionId}", $params);
    }
}
