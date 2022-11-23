<?php

declare(strict_types=1);

namespace Consul\API\Client;

use Consul\API\Response\ConsulResponseInterface;

interface ClientInterface
{
    /**
     * Execute GET requests
     *
     * @param string               $url     Endpoint.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function get(string $url, array $options = []): ConsulResponseInterface;

    /**
     * Execute HEAD requests
     *
     * @param string               $url     Endpoint.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function head(string $url, array $options = []): ConsulResponseInterface;

    /**
     * Execute DELETE requests
     *
     * @param string               $url     Endpoint.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function delete(string $url, array $options = []): ConsulResponseInterface;

    /**
     * Execute PUT requests
     *
     * @param string               $url     Endpoint.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function put(string $url, array $options = []): ConsulResponseInterface;

    /**
     * Execute PATCH requests
     *
     * @param string               $url     Endpoint.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function patch(string $url, array $options = []): ConsulResponseInterface;

    /**
     * Execute POST requests
     *
     * @param string               $url     Endpoint.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function post(string $url, array $options = []): ConsulResponseInterface;

    /**
     * Execute OPTIONS requests
     *
     * @param string               $url     Endpoint.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function options(string $url, array $options = []): ConsulResponseInterface;
}
