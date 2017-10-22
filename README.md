# SphereMall Gateway PHP SDK
Official PHP SDK for integrating with **SphereMall Product**.
[Official documentation](https://spheremall.atlassian.net/wiki/spaces/MIC/pages)

### Version 1.0.1
#### Supported microservices
* Gateway 1.1.0
* Product 1.0.0

## Installation
You can install the package manually or by adding it to your `composer.json`:
```
{
  "require": {
      "spheremall/php-ms-client": "1.0.1"
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
To return a list of your resources
```php
// return a list of your products 
$client->products()->all();
```

### Single Resource by ID
Fetch a Resource by ID:
```php
$client->products->get($productId);
```
### Limiting and Offsetting Results

```php
// limit the number of resources returned:
$client->products()
       ->limit(5)
       ->all();

// offset the results (page 2):
$client->products
       ->limit(10, 10)
       ->all();
```
### Filtering result with specific fields

```php
// Get resource by id with specific fields:
$client->products()
       ->fields(['id', 'title'])
       ->get($productId);
       
// Get list of resources with specific fields:
$client->products()
       ->fields(['id', 'title'])
       ->limit(10)
       ->all();
```
### Filtering Results
`Equal` filter with product title:
```php
$client->products()
       ->filter([
            'title' => [FilterOperators::EQUAL => 'product title'],
            ])
       ->limit(1)
       ->all();
```
`Not equal` filter with product title:
```php
$client->products()
       ->filter([
            'title' => [FilterOperators::NOT_EQUAL => 'product title'],
            ])
       ->limit(1)
       ->all();
```
`Like` filter with product title (%product title%):
```php
$client->products()
       ->filter([
            'title' => [FilterOperators::LIKE => 'product title'],
            ])
       ->limit(1)
       ->all();
```
Left `like` filter with product title (%product title):
```php
$client->products()
       ->filter([
            'title' => [FilterOperators::LIKE_LEFT => 'product title'],
            ])
       ->limit(1)
       ->all();
```
Right `like` filter with product title (product title%):
```php
$client->products()
       ->filter([
            'title' => [FilterOperators::LIKE_RIGHT => 'product title'],
            ])
       ->limit(1)
       ->all();
```
`Greater than` filter with product price (price > 60000):
```php
$client->products()
       ->filter([
            'price' => [FilterOperators::GREATER_THAN => 60000],
            ])
       ->limit(1)
       ->all();
```
`Less than` filter with product price (price < 60000):
```php
$client->products()
       ->filter([
            'price' => [FilterOperators::LESS_THAN => 60000],
            ])
       ->limit(1)
       ->all();
```
`Greater or equal than` filter with product price (price >= 60000):
```php
$client->products()
       ->filter([
            'price' => [FilterOperators::GREATER_THAN_OR_EQUAL => 60000],
            ])
       ->limit(1)
       ->all();
```
`Less or equal than` filter with product price (price <= 60000):
```php
$client->products()
       ->filter([
            'price' => [FilterOperators::LESS_THAN_OR_EQUAL => 60000],
            ])
       ->limit(1)
       ->all();
```

`Is null` filter with product titleMask (titleMask == null):
```php
$client->products()
       ->filter([
            'titleMask' => [FilterOperators::IS_NULL => 'null'],
            ])
       ->limit(1)
       ->all();
```