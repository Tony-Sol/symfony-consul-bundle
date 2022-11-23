<?php

declare(strict_types=1);

namespace Consul\Engine\Agent;

use Consul\Engine\AbstractEngine;
use Consul\API\Response\ConsulResponseInterface;

final class Agent extends AbstractEngine implements AgentInterface
{
    /**
     * {@inheritdoc}
     *
     * @return ConsulResponseInterface
     */
    public function checks(): ConsulResponseInterface
    {
        return $this->client->get("/{$this->apiVersion}/agent/checks");
    }

    /**
     * {@inheritdoc}
     *
     * @return ConsulResponseInterface
     */
    public function services(): ConsulResponseInterface
    {
        return $this->client->get("/{$this->apiVersion}/agent/services");
    }

    /**
     * {@inheritdoc}
     *
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function members(array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['wan'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/agent/members", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @return ConsulResponseInterface
     */
    public function self(): ConsulResponseInterface
    {
        return $this->client->get("/{$this->apiVersion}/agent/self");
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $address Join address.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function join(string $address, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['wan'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->get("/{$this->apiVersion}/agent/join/{$address}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $node Node to leave.
     *
     * @return ConsulResponseInterface
     */
    public function forceLeave(string $node): ConsulResponseInterface
    {
        return $this->client->get("/{$this->apiVersion}/agent/force-leave/{$node}");
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $check Check to register.
     *
     * @return ConsulResponseInterface
     */
    public function registerCheck(mixed $check): ConsulResponseInterface
    {
        $params = ['body' => $check];
        return $this->client->put("/{$this->apiVersion}/agent/check/register", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $checkId Check ID to deregister.
     *
     * @return ConsulResponseInterface
     */
    public function deregisterCheck(string $checkId): ConsulResponseInterface
    {
        return $this->client->put("/{$this->apiVersion}/agent/check/deregister/{$checkId}");
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $checkId Check ID.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function passCheck(string $checkId, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['note'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->put("/{$this->apiVersion}/agent/check/pass/{$checkId}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $checkId Check ID.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function warningCheck(string $checkId, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['note'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->put("/{$this->apiVersion}/agent/check/warn/{$checkId}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string               $checkId Check ID.
     * @param array<string, mixed> $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function failCheck(string $checkId, array $options = []): ConsulResponseInterface
    {
        $availableOptions = ['note'];
        $params           = [
            'query' => $this->resolveOptions($options, $availableOptions),
        ];
        return $this->client->put("/{$this->apiVersion}/agent/check/fail/{$checkId}", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $service Service to register.
     *
     * @return ConsulResponseInterface
     */
    public function registerService(mixed $service): ConsulResponseInterface
    {
        $params = ['body' => $service];
        return $this->client->put("/{$this->apiVersion}/agent/service/register", $params);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $serviceId Service ID to deregister.
     *
     * @return ConsulResponseInterface
     */
    public function deregisterService(string $serviceId): ConsulResponseInterface
    {
        return $this->client->put("/{$this->apiVersion}/agent/service/deregister/{$serviceId}");
    }
}
