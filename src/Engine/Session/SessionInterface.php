<?php

declare(strict_types=1);

namespace Consul\Engine\Session;

use Consul\API\Response\ConsulResponseInterface;
use Consul\Engine\AbstractEngineInterface;

interface SessionInterface extends AbstractEngineInterface
{
    /**
     * Execute Create Consul Session
     *
     * @param mixed $body    Session body.
     * @param array $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function create(mixed $body = null, array $options = []): ConsulResponseInterface;

    /**
     * Execute Destroy Consul Session
     *
     * @param string $sessionId Session ID.
     * @param array  $options   Request options.
     *
     * @return ConsulResponseInterface
     */
    public function destroy(string $sessionId, array $options = []): ConsulResponseInterface;

    /**
     * Execute Info Consul Session
     *
     * @param string $sessionId Session ID.
     * @param array  $options   Request options.
     *
     * @return ConsulResponseInterface
     */
    public function info(string $sessionId, array $options = []): ConsulResponseInterface;

    /**
     * Execute Node Consul Session
     *
     * @param string $node    Session node.
     * @param array  $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function node(string $node, array $options = []): ConsulResponseInterface;

    /**
     * Execute List Consul Session
     *
     * @param array $options Request options.
     *
     * @return ConsulResponseInterface
     */
    public function list(array $options = []): ConsulResponseInterface;

    /**
     * Execute Renew Consul Session
     *
     * @param string $sessionId Session ID.
     * @param array  $options   Request options.
     *
     * @return ConsulResponseInterface
     */
    public function renew(string $sessionId, array $options = []): ConsulResponseInterface;
}
