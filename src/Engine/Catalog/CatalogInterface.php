<?php

declare(strict_types=1);

namespace Consul\Engine\Catalog;

use Consul\API\Response\ConsulResponseInterface;
use Consul\Engine\AbstractEngineInterface;

interface CatalogInterface extends AbstractEngineInterface
{
    /**
     * Execute Register Consul Catalog
     *
     * @param string $node Catalog node.
     *
     * @return ConsulResponseInterface
     */
    public function register(string $node): ConsulResponseInterface;

    /**
     * Execute Deregister Consul Catalog
     *
     * @param string $node Health node.
     *
     * @return ConsulResponseInterface
     */
    public function deRegister(string $node): ConsulResponseInterface;

    /**
     * Execute Datacenters Consul Catalog
     *
     * @return ConsulResponseInterface
     */
    public function dataCenters(): ConsulResponseInterface;

    /**
     * Execute Nodes Consul Catalog
     *
     * @param array $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function nodes(array $options = []): ConsulResponseInterface;

    /**
     * Execute Node Consul Catalog
     *
     * @param string $node    Catalog node.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function node(string $node, array $options = []): ConsulResponseInterface;

    /**
     * Execute Services Consul Catalog
     *
     * @param array $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function services(array $options = []): ConsulResponseInterface;

    /**
     * Execute Service Consul Catalog
     *
     * @param string $service Catalog service.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function service(string $service, array $options = []): ConsulResponseInterface;
}
