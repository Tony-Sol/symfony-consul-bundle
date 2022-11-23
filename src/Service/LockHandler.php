<?php

declare(strict_types=1);

namespace Consul\Service;

use Consul\Engine\KV;
use Consul\Engine\Session;

final class LockHandler implements LockHandlerInterface
{
    private Session\SessionInterface $session;

    private KV\KVInterface $kv;

    /**
     * @var array<string, string>
     */
    private static array $sessionsContainer = [];

    /**
     * LockHandler constructor
     *
     * @param ConsulServiceFactoryInterface $consulServiceFactory Consul service factory.
     */
    public function __construct(ConsulServiceFactoryInterface $consulServiceFactory)
    {
        $this->session = $consulServiceFactory->getSessionEngine();
        $this->kv      = $consulServiceFactory->getKVEngine();
    }

    /**
     * {@inheritdoc}
     *
     * @param string $key   Locking key.
     * @param mixed  $value Locking value.
     *
     * @return boolean
     */
    public function lock(string $key, mixed $value = null): bool
    {
        // Start a session.
        /** @var mixed $sessionId */
        $sessionId = ($this->session->create()->jsonSerialize()['ID'] ?? null);
        if ($sessionId === null) {
            return false;
        }
        self::$sessionsContainer[$key] = (string)$sessionId;

        // Lock a key / value with the current session.
        /** @var mixed $lockAcquired */
        $lockAcquired = $this
            ->kv
            ->put($key, (string)$value, ['acquire' => self::$sessionsContainer[$key]])
            ->jsonSerialize()
        ;
        // phpcs:disable Squiz.Operators.ComparisonOperatorUsage.NotAllowed
        if (!$lockAcquired) {
            $this->session->destroy(self::$sessionsContainer[$key]);
            return false;
        }
        // phpcs:enable
        register_shutdown_function([$this, 'release'], $key);
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $key Locking key.
     *
     * @return void
     */
    public function release(string $key): void
    {
        $sessionId = (self::$sessionsContainer[$key] ?? null);
        if ($sessionId !== null) {
            $this->kv->delete($key);
            $this->session->destroy($sessionId);
        }
    }
}
