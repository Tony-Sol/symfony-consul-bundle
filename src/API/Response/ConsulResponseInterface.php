<?php

declare(strict_types=1);

namespace Consul\API\Response;

interface ConsulResponseInterface extends \JsonSerializable, \Stringable
{
    /**
     * Get response headers
     *
     * @return array<array-key, array<array-key, string>>
     */
    public function getHeaders(): array;

    /**
     * Get response body
     *
     * @return string
     */
    public function getBody(): string;

    /**
     * Get response status code
     *
     * @return integer
     */
    public function getStatusCode(): int;
}
