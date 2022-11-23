<?php

declare(strict_types=1);

namespace Consul\API\Response;

final class ConsulResponse implements ConsulResponseInterface
{
    /**
     * Consul Response constructor
     *
     * @param array<array-key, array<array-key, string>> $headers Response headers.
     * @param string                                     $body    Response body.
     * @param integer                                    $status  Response status code.
     */
    public function __construct(
        private array $headers,
        private string $body,
        private int $status = 200
    ) {
    }

    /**
     * {@inheritdoc}
     *
     * @return array<array-key, array<array-key, string>>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getStatusCode(): int
    {
        return $this->status;
    }

    /**
     * Response JSON representation
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return \json_decode($this->body, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Response string representation
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getBody();
    }
}
