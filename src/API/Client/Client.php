<?php

declare(strict_types=1);

namespace Consul\API\Client;

use Consul\Exception;
use Consul\API\Response;
use GuzzleHttp;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Client implements ClientInterface
{
    /**
     * Client constructor
     *
     * @param ContainerInterface         $container Container.
     * @param GuzzleHttp\ClientInterface $client    GuzzleHTTP client instance.
     * @param LoggerInterface            $logger    Logger.
     */
    public function __construct(
        private ContainerInterface $container,
        private GuzzleHttp\ClientInterface $client,
        private LoggerInterface $logger
    ) {
    }

    /**
     * {@inheritdoc}
     *
     * @param string $url     Endpoint.
     * @param array  $options Request options.
     *
     * @return Response\ConsulResponseInterface
     */
    public function get(string $url, array $options = []): Response\ConsulResponseInterface
    {
        return $this->doRequest('GET', $url, $options);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $url     Endpoint.
     * @param array  $options Request options.
     *
     * @return Response\ConsulResponseInterface
     */
    public function head(string $url, array $options = []): Response\ConsulResponseInterface
    {
        return $this->doRequest('HEAD', $url, $options);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $url     Endpoint.
     * @param array  $options Request options.
     *
     * @return Response\ConsulResponseInterface
     */
    public function delete(string $url, array $options = []): Response\ConsulResponseInterface
    {
        return $this->doRequest('DELETE', $url, $options);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $url     Endpoint.
     * @param array  $options Request options.
     *
     * @return Response\ConsulResponseInterface
     */
    public function put(string $url, array $options = []): Response\ConsulResponseInterface
    {
        return $this->doRequest('PUT', $url, $options);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $url     Endpoint.
     * @param array  $options Request options.
     *
     * @return Response\ConsulResponseInterface
     */
    public function patch(string $url, array $options = []): Response\ConsulResponseInterface
    {
        return $this->doRequest('PATCH', $url, $options);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $url     Endpoint.
     * @param array  $options Request options.
     *
     * @return Response\ConsulResponseInterface
     */
    public function post(string $url, array $options = []): Response\ConsulResponseInterface
    {
        return $this->doRequest('POST', $url, $options);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $url     Endpoint.
     * @param array  $options Request options.
     *
     * @return Response\ConsulResponseInterface
     */
    public function options(string $url, array $options = []): Response\ConsulResponseInterface
    {
        return $this->doRequest('OPTIONS', $url, $options);
    }

    /**
     * Do request
     *
     * @param string $method  HTTP method.
     * @param string $url     Endpoint.
     * @param array  $options Request options.
     *
     * @throws Exception\ServerException
     * @throws Exception\ClientException
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     *
     * @return Response\ConsulResponseInterface
     */
    protected function doRequest(
        string $method,
        string $url,
        array $options,
    ): Response\ConsulResponseInterface {
        $options['base_uri'] = $this->container->getParameter('consul.base_uri');
        $options['timeout']  = $this->container->getParameter('consul.timeout');

        if (isset($options['body']) && \is_array($options['body'])) {
            $options['body'] = json_encode(
                $options['body'],
                (JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            );
        }

        $this->logger->info("{$method} '{$url}'");
        $this->logger->debug(
            "Requesting {$method} {$url}",
            ['options' => $options]
        );

        try {
            $response = $this->client->request($method, $url, $options);
        } catch (GuzzleHttp\Exception\BadResponseException $throwable) {
            $response = $throwable->getResponse();
        } catch (\Throwable $throwable) {
            $message = "Something went wrong when calling consul '{$throwable->getMessage()}'";
            $this->logger->error($message);
            throw new Exception\ServerException($message);
        }

        $responseContent    = $response->getBody()->getContents();
        $responseHeaders    = $response->getHeaders();
        $responseStatusCode = $response->getStatusCode();
        $this->logger->debug(
            "Response: {$responseStatusCode} {$responseContent}",
            ['headers' => $responseHeaders]
        );

        if ($responseStatusCode >= 400) {
            $message = "Something went wrong when calling consul ({$responseStatusCode})";
            $this->logger->error($message);
            $message .= "\n{$responseContent}";
            if ($responseStatusCode >= 500) {
                throw new Exception\ServerException($message, $responseStatusCode);
            }
            throw new Exception\ClientException($message, $response->getStatusCode());
        }

        return new Response\ConsulResponse($responseHeaders, $responseContent, $responseStatusCode);
    }
}
