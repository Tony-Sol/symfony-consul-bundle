<?php

declare(strict_types=1);

namespace Consul\Engine\TXN;

use Consul\Engine\AbstractEngine;
use Consul\Exception\InvalidOperations;
use Consul\API\Response\ConsulResponseInterface;

final class TXN extends AbstractEngine implements TXNInterface
{
    /**
     * {@inheritdoc}
     *
     * @param array<int, array<string, mixed>> $operations TXN operations.
     * @param array<string, mixed>             $options    Request options.
     *
     * @return ConsulResponseInterface
     */
    public function put(array $operations = [], array $options = []): ConsulResponseInterface
    {
        $this->validate($operations);
        $availableOptions = ['dc'];
        $params           = [
            'body'  => json_encode(
                $operations,
                (JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            ),
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->put("/{$this->apiVersion}/txn", $params);
    }

    /**
     * Validate Transaction Available Operations
     *
     * @param array<int, array<string, mixed>> $operations TXN operations.
     *
     * @throws InvalidOperations
     *
     * @return void
     */
    private function validate(array $operations = []): void
    {
        foreach ($operations as $operation) {
            $invalidOperations = array_diff(array_keys($operation), ['KV', 'Node', 'Service', 'Check']);
            if (count($invalidOperations) > 0) {
                throw new InvalidOperations('Invalid Operations!');
            }
        }
    }
}
