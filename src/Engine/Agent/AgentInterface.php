<?php

declare(strict_types=1);

namespace Consul\Engine\Agent;

use Consul\API\Response\ConsulResponseInterface;
use Consul\Engine\AbstractEngineInterface;

interface AgentInterface extends AbstractEngineInterface
{
    /**
     * Execute Checks Consul Agent
     *
     * @return ConsulResponseInterface
     */
    public function checks(): ConsulResponseInterface;

    /**
     * Execute Services Consul Agent
     *
     * @return ConsulResponseInterface
     */
    public function services(): ConsulResponseInterface;

    /**
     * Execute Members Consul Agent
     *
     * @param array $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function members(array $options = []): ConsulResponseInterface;

    /**
     * Execute Self Consul Agent
     *
     * @return ConsulResponseInterface
     */
    public function self(): ConsulResponseInterface;

    /**
     * Execute Join Consul Agent
     *
     * @param string $address Join address.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function join(string $address, array $options = []): ConsulResponseInterface;

    /**
     * Execute ForceLeave Consul Agent
     *
     * @param string $node Node to leave.
     *
     * @return ConsulResponseInterface
     */
    public function forceLeave(string $node): ConsulResponseInterface;

    /**
     * Execute RegisterCheck Consul Agent
     *
     * @param mixed $check Check to register.
     *
     * @return ConsulResponseInterface
     */
    public function registerCheck(mixed $check): ConsulResponseInterface;

    /**
     * Execute DeregisterCheck Consul Agent
     *
     * @param string $checkId Check ID to deregister.
     *
     * @return ConsulResponseInterface
     */
    public function deregisterCheck(string $checkId): ConsulResponseInterface;

    /**
     * Execute PassCheck Consul Agent
     *
     * @param string $checkId Check ID.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function passCheck(string $checkId, array $options = []): ConsulResponseInterface;

    /**
     * Execute WarningCheck Consul Agent
     *
     * @param string $checkId Check ID.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function warningCheck(string $checkId, array $options = []): ConsulResponseInterface;

    /**
     * Execute FailCheck Consul Agent
     *
     * @param string $checkId Check ID.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function failCheck(string $checkId, array $options = []): ConsulResponseInterface;

    /**
     * Execute DeregisterService Consul Agent
     *
     * @param mixed $service Service to register.
     *
     * @return ConsulResponseInterface
     */
    public function registerService(mixed $service): ConsulResponseInterface;

    /**
     * Execute DeregisterService Consul Agent
     *
     * @param string $serviceId Service ID to deregister.
     *
     * @return ConsulResponseInterface
     */
    public function deregisterService(string $serviceId): ConsulResponseInterface;
}
