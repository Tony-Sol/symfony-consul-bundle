<?php

declare(strict_types=1);

namespace Consul\Service;

interface LockHandlerInterface
{
    /**
     * Lock value in current session
     *
     * @param string $key   Locking key.
     * @param mixed  $value Locking value.
     *
     * @return boolean
     */
    public function lock(string $key, mixed $value = null): bool;

    /**
     * Release lock
     *
     * @param string $key Locking key.
     *
     * @return void
     */
    public function release(string $key): void;
}
