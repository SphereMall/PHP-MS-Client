# SphereMall Gateway PHP SDK
Official PHP SDK for integrating with **SphereMall Product**.
[Official documentation](https://spheremall.atlassian.net/wiki/spaces/MIC/pages)

### Version 1.0.2
#### Supported microservices
* Gateway 1.1.1
* Product 1.1.0
* Shop 1.0.1
* Users 1.0.0

## Installation
You can install the package manually or by adding it to your `composer.json`:
```
{
  "require": {
      "spheremall/ms-client": "1.0.2"
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
## Using the client with base Resources functionality
* [Multiple Resources](https://github.com/SphereMall/PHP-MS-Client/wiki/Multiple-Resources)
* [Single Resource by ID](https://github.com/SphereMall/PHP-MS-Client/wiki/Single-Resource-by-ID)
* [Limiting and Offsetting Results](https://github.com/SphereMall/PHP-MS-Client/wiki/Limiting-and-Offsetting-Results)
* [Filtering result with specific fields](https://github.com/SphereMall/PHP-MS-Client/wiki/Filtering-result-with-specific-fields)

### Sorting Results 
```php
// order by `title` ASC:
$client->products()
       ->sort('title')
       ->all();
       
// order by `title` DESC:
$client->products()
        ->sort('-title')
        ->all();
```

### Counting Results 
```php
// Return integer with amount of entities base on filter and ignored limit:
$client->products()
       ->filter([
        'price' => [FilterOperators::LESS_THAN_OR_EQUAL => 60000],
        ])
       ->limit(2)
       ->sort('title')
       ->count();
```

## Product Resource
### Get full 
```php
// get list of products with full included data:
$client->products()       
       ->limit(2)
       ->full();
       
// get full product data by id:
$client->products()
       ->full(1);
       
// get full product data by urlCode:
$client->products()
       ->full('url-code');
```

## Shop
### Get basket by id
```php
// Get basket by id
$basket = $client->basket($basketId);

//Get basket items:
$items = $basket->getItems();

//Get basket id:
$basketId = $basket->getId();
```

### Add products to empty basket
```php
$basket = $client->basket();

//Add product with id 1 and 2 and amount 1
$basket->add([
            [
                'id'        => 1,
                'amount'    => 1,
            ],
            [
                'id'        => 2,
                'amount'    => 1,
            ],
        ]);

//Get basket items:
$items = $basket->getItems();
```

### Add products to existing basket
```php
// Get basket by id
$basket = $client->basket($basketId);

//Add product with id 1 and amount 1
$basket->add([
            [
                'id'        => 1,
                'amount'    => 1,
            ],
        ]);
```
### Remove product from basket
```php
// Get basket by id
$basket = $client->basket($basketId);

$basket->remove([
            [
                'id'    => 1
            ],
        ]);
```

### Update product amount in the basket for product id 1
```php
// Get basket by id
$basket = $client->basket($basketId);

$basket->update([
            [
                'id'     => 1,
                'amount' => 3,
            ],
        ]);
```

### Set basket delivery method
```php
// Get basket by id
$basket = $client->basket($basketId);

// Get delivery provider
$deliveryProviders = $client->deliveryProviders()
                            ->limit(1)
                            ->all();

// Set Delivery object with delivery provider injection
$delivery = new Delivery($deliveryProviders->current());

// Set delivery to basket                            
$basket->setDelivery()
       ->update();
```

### Set basket shipping and billing addresses
```php
// Get basket by id
$basket = $client->basket($basketId);

// Set address object
$address = new Address([
            'name'    => 'test',
            'surname' => 'test',
        ]);

// Set basket shipping address
$basket->setShippingAddress($address)
       ->update();

// Set basket billing address
$basket->setBillingAddress($address)
       ->update();
```

### Set basket payment method
```php
// Get basket by id
$basket = $client->basket($basketId);

// Get payment method
$paymentCollection = $client->paymentMethods()
                            ->limit(1)
                            ->all();
                            
// Set payment method id to basket
$basket->setPaymentMethod($paymentCollection->current()->id)
       ->update();
```