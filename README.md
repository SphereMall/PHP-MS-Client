# SphereMall Gateway PHP SDK
Official PHP SDK for integrating with **SphereMall Product**.
[Official documentation](https://spheremall.atlassian.net/wiki/spaces/MIC/pages)

### Version 1.0.0
#### Supported microservices
* Gateway 1.1.0
* Product 1.0.0

## Installation
You can install the package manually or by adding it to your `composer.json`:
```
{
  "require": {
      "spheremall/php-ms-client": "1.0.0"
  }
}
```
## Instantiating the SDK Client:

Pass in the configuration to the client:

```php
$client = new Client([
            'gatewayUrl' => 'API_GATEWAY_URL',
            'clientId'   => 'API_CLIENT_ID',
            'secretKey'  => 'API_SECRET_KEY'
        ]);
```
## Using the client
### Multiple Resources