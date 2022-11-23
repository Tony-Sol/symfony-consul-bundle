<?php

declare(strict_types=1);

namespace Consul\Engine\KV;

use Consul\Engine\AbstractEngine;
use Consul\API\Response\ConsulResponseInterface;

// phpcs:disable Squiz.Arrays.ArrayDeclaration.SingleLineNotAllowed
final class KV extends AbstractEngine implements KVInterface
{
    /**
     * {@inheritdoc}
     *
     * @param string               $key     KV Key.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function get(string $key, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc', 'recurse', 'keys', 'separator', 'raw', 'stale', 'consistent', 'default'];
        $defaultOptions   = ['raw' => 1];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions, $defaultOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/kv/{$this->appDirectory}/{$key}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string                                        $key     KV Key.
     * @param \Stringable|string|integer|float|boolean|null $value   KV Value.
     * @param array<string, mixed>                          $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function put(string $key, mixed $value, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc', 'flags', 'cas', 'acquire', 'release'];
        $params           = [
            'body'  => (string)$value,
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->put("/{$this->apiVersion}/kv/{$this->appDirectory}/{$key}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $key     KV Key.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function delete(string $key, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['dc', 'recurse'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->delete("/{$this->apiVersion}/kv/{$this->appDirectory}/{$key}", $params);
    }
}
// phpcs:enable
