<?php

declare(strict_types=1);

namespace Consul\Engine\Health;

use Consul\API\Response\ConsulResponseInterface;
use Consul\Engine\AbstractEngineInterface;

interface HealthInterface extends AbstractEngineInterface
{
    /**
     * Execute Node Consul Health
     *
     * @param string $node    Health node.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function node(string $node, array $options = []): ConsulResponseInterface;

    /**
     * Execute Check Consul Health
     *
     * @param string $service Health service.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function checks(string $service, array $options = []): ConsulResponseInterface;

    /**
     * Execute Service Consul Health
     *
     * @param string $service Health service.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function service(string $service, array $options = []): ConsulResponseInterface;

    /**
     * Execute State Consul Health
     *
     * @param string $state   Health state.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function state(string $state, array $options = []): ConsulResponseInterface;
}
