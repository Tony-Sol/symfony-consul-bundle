<?php

declare(strict_types=1);

namespace Consul\Service;

use Consul\Engine\AbstractEngineInterface;
use Consul\Engine\Agent;
use Consul\Engine\Catalog;
use Consul\Engine\Health;
use Consul\Engine\Session;
use Consul\Engine\KV;
use Consul\Engine\TXN;
use Consul\API\Client;
use Psr\Log\LoggerInterface;
use GuzzleHttp\ClientInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class ConsulServiceFactory implements ConsulServiceFactoryInterface
{
    protected array $services = [
        Agent\AgentInterface::class     => Agent\Agent::class,
        Catalog\CatalogInterface::class => Catalog\Catalog::class,
        Health\HealthInterface::class   => Health\Health::class,
        Session\SessionInterface::class => Session\Session::class,
        KV\KVInterface::class           => KV\KV::class,
        TXN\TXNInterface::class         => TXN\TXN::class,
    ];

    /** @var AbstractEngineInterface[] */
    protected static array $serviceContainer = [];

    protected Client\ClientInterface $client;

    /**
     * ConsulServiceFactory constructor.
     *
     * @param ContainerInterface $container  Container instance.
     * @param ClientInterface    $httpClient Client instance.
     * @param LoggerInterface    $logger     Logger instance.
     */
    public function __construct(
        protected ContainerInterface $container,
        ClientInterface $httpClient,
        LoggerInterface $logger
    ) {
        $this->client = new Client\Client($container, $httpClient, $logger);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     *
     * @return Agent\AgentInterface
     */
    public function getAgentEngine(): Agent\AgentInterface
    {
        return $this->get(Agent\AgentInterface::class);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     *
     * @return Catalog\CatalogInterface
     */
    public function getCatalogEngine(): Catalog\CatalogInterface
    {
        return $this->get(Catalog\CatalogInterface::class);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     *
     * @return Health\HealthInterface
     */
    public function getHealthEngine(): Health\HealthInterface
    {
        return $this->get(Health\HealthInterface::class);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     *
     * @return Session\SessionInterface
     */
    public function getSessionEngine(): Session\SessionInterface
    {
        return $this->get(Session\SessionInterface::class);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     *
     * @return KV\KVInterface
     */
    public function getKVEngine(): KV\KVInterface
    {
        return $this->get(KV\KVInterface::class);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     *
     * @return TXN\TXNInterface
     */
    public function getTXNEngine(): TXN\TXNInterface
    {
        return $this->get(TXN\TXNInterface::class);
    }

    /**
     * {@inheritdoc}
     *
     * @return LockHandlerInterface
     */
    public function getLockHandler(): LockHandlerInterface
    {
        return new LockHandler($this);
    }

    /**
     * Create and get engine instance
     *
     * @param class-string $service Engine class name.
     *
     * @throws \InvalidArgumentException
     *
     * @return AbstractEngineInterface
     *
     * @todo           Deal with suppressions:
     * @psalm-suppress InvalidReturnType, InvalidReturnStatement
     * @psalm-template T of AbstractEngineInterface
     * @psalm-param    class-string<T> $service
     * @psalm-return   T
     */
    protected function get(string $service): AbstractEngineInterface
    {
        /** @var class-string<T>|null $class */
        $class = ($this->services[$service] ?? null);
        if ($class === null) {
            throw new \InvalidArgumentException("The service '{$service}' is not available.");
        }
        if ((self::$serviceContainer[$class] ?? null) === null) {
            self::$serviceContainer[$class] = new $class($this->container, $this->client);
        }
        return self::$serviceContainer[$class];
    }
}
