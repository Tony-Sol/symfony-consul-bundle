<?php

declare(strict_types=1);

namespace Consul\Engine\KV;

use Consul\API\Response\ConsulResponseInterface;
use Consul\Engine\AbstractEngineInterface;

interface KVInterface extends AbstractEngineInterface
{
    /**
     * Execute Get Consul KV
     *
     * @param string               $key     KV Key.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function get(string $key, array $options = []): ConsulResponseInterface;

    /**
     * Execute Put Consul KV
     *
     * @param string                                        $key     KV Key.
     * @param \Stringable|string|integer|float|boolean|null $value   KV Value.
     * @param array<string, mixed>                          $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function put(string $key, mixed $value, array $options = []): ConsulResponseInterface;

    /**
     * Execute Delete COnsul KV
     *
     * @param string               $key     KV Key.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function delete(string $key, array $options = []): ConsulResponseInterface;
}
