<?php

declare(strict_types=1);

namespace Consul\Service;

use Consul\Engine\Agent;
use Consul\Engine\Catalog;
use Consul\Engine\Health;
use Consul\Engine\Session;
use Consul\Engine\KV;
use Consul\Engine\TXN;

interface ConsulServiceFactoryInterface
{
    /**
     * Get Agent Engine
     *
     * @throws \InvalidArgumentException
     *
     * @return Agent\AgentInterface
     */
    public function getAgentEngine(): Agent\AgentInterface;

    /**
     * Get Catalog Engine
     *
     * @throws \InvalidArgumentException
     *
     * @return Catalog\CatalogInterface
     */
    public function getCatalogEngine(): Catalog\CatalogInterface;

    /**
     * Get Health Engine
     *
     * @throws \InvalidArgumentException
     *
     * @return Health\HealthInterface
     */
    public function getHealthEngine(): Health\HealthInterface;

    /**
     * Get Session Engine
     *
     * @throws \InvalidArgumentException
     *
     * @return Session\SessionInterface
     */
    public function getSessionEngine(): Session\SessionInterface;

    /**
     * Get KV Engine
     *
     * @throws \InvalidArgumentException
     *
     * @return KV\KVInterface
     */
    public function getKVEngine(): KV\KVInterface;

    /**
     * Get TXN Engine
     *
     * @throws \InvalidArgumentException
     *
     * @return TXN\TXNInterface
     */
    public function getTXNEngine(): TXN\TXNInterface;

    /**
     * Get LockHandler Service
     *
     * @return LockHandlerInterface
     */
    public function getLockHandler(): LockHandlerInterface;
}
