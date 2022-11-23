# Consul Bundle

## Requires these environment variables to be set:

```shell
CONSUL_HTTP_ADDRESS="localhost:8500"
CONSUL_API_VERSION="v1"
CONSUL_TIMEOUT=1
```

## Required configuration example for KV Storage

```yaml
consul_kv_provider:
    class: Consul\Engine\KV\KV
    factory: [ '@Consul\Service\ConsulServiceFactory', 'getKVEngine' ]

Consul\Engine\KV\KVInterface: '@consul_kv_provider'
```

## Usage example

```php
public function __construct(
        private \Consul\Engine\KV\KVInterface $consulKVStorage
) {
}

public function set(): void
{
    $key = 'foo';
    $value = 'bar';
    $this->consulKVStorage->set($key, $value);
}

public function get(): void
{
    $key = 'foo';
    $value = $this->consulKVStorage->get($key);
        // $value instanceof ConsulResponseInterface
        // (string)$value = 'bar'
}
```
## Disclaimer

All information and source code are provided AS-IS, without express or implied warranties.
Use of the source code or parts of it is at your sole discretion and risk.
Citymobil LLC takes reasonable measures to ensure the relevance of the information posted in this repository, but it does not assume responsibility for maintaining or updating this repository or its parts outside the framework established by the company independently and without notifying third parties.


Вся информация и исходный код предоставляются в исходном виде, без явно выраженных или подразумеваемых гарантий. Использование исходного кода или его части осуществляются исключительно по вашему усмотрению и на ваш риск. Компания ООО "Ситимобил" принимает разумные меры для обеспечения актуальности информации, размещенной в данном репозитории, но она не принимает на себя ответственности за поддержку или актуализацию данного репозитория или его частей вне рамок, устанавливаемых компанией самостоятельно и без уведомления третьих лиц.
