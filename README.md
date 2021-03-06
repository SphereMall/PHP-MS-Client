# SphereMall Gateway PHP SDK
Official PHP SDK for integrating with **SphereMall Product**.
[Official documentation](https://spheremall.atlassian.net/wiki/spaces/MIC/pages)

### Version 2.8.18.2
* Added possibility to delete some parameters from Elastic FilterBuilder

### Version 2.8.18.1
* Fixed filter builder for "isMain" parameters to elasticserch facets

### Version 2.8.17
* Added filter builder for "isMain" parameters to elasticserch facets

### Version 2.8.15
* Exclude negative factor items from elasticsearch response (using SortBuilder)

### Version 2.8.14.1
* Minor changes in CorrelationsResourse for preparing elsaticsearch query

### Version 2.8.14
* Add channels resource

### Version 2.8.13.1
* Changes in ObjectMaker for `included`
* Changes in `ProductsMapper`, `DocumentsMapper`, `EntityGroupsMapper` and `CategoriesMapper`

### Version 2.8.12
* ObjectMaker extended with `included` to be able to find nested relationships (for example MediaEntities -> Media)

### Version 2.8.11
* Add `boost` support for ElasticSearch queries: `WildCardQuery`, `TermsQuery`, `DistanceQuery`, `RangeQuery`

### Version 2.8.10.1
* Add ```deleteDocumentFromIndex``` method to ```ElasticResource``` resource

### Version 2.8.9
* Add ```WebSites``` and ```WebSiteSettings``` resources

### Version 2.8.6
## Implementation of updates for `comments` entity:
* https://spheremall.atlassian.net/wiki/spaces/MIC/pages/1394049130/Comments+3.0.0+Release+Notes

### Version 2.8.5
## Implementation of:
* https://spheremall.atlassian.net/wiki/spaces/MIC/pages/1291485243/Grapher+2.3.6+Release+Notes
* https://spheremall.atlassian.net/wiki/spaces/MIC/pages/1304592428/Grapher+2.3.7+Release+Notes

### Version 2.8.4.8
## Extend OrderFinalized with deliveryTime

### Version 2.8.4.7
## Fix DistanceQuery (added possibility to set field name)

### Version 2.8.4.6
## Fix correlation resource when use withMeta

### Version 2.8.4.5
## Fix entity factors set() method

### Version 2.8.4.4
## Fix for multi price range params

### Version 2.8.4.3
## Add AttributeRangeConfig

### Version 2.8.4.2
## Fix OrdersMaker signature

### Version 2.8.4.1
## Change filter builder config bug

### [Version 2.8.3](https://spheremall.atlassian.net/browse/MIC-1245)
## Check success response refactored
## HttpHelper refactored for checking port in url
## ObjectMaker refactored (temporary solution) to get all included, not only from relations

### [Version 2.8.2](https://spheremall.atlassian.net/browse/M20-156)
## Fix url-s for elastic resource 
## Implement JsonSerializable for Entity

### [Version 2.8.1](https://spheremall.atlassian.net/browse/M20-109)
## Update work with filter params for elasticfilter
## ! This version is compatible with MS Indexer >= 2.5.4 !

### [Version 2.8.0](https://spheremall.atlassian.net/browse/MIC-1227)
## Update correlation resource for working with elasticsearch
## ! This version is compatible with MS Grapher >= 2.3.4.5 !

### [Version 2.7.24](https://spheremall.atlassian.net/browse/M20-96)
## Add CRUD wrapping for Marketing microservice

### [Version 2.7.23](https://spheremall.atlassian.net/browse/M20-80)
## Add CRUD wrapping for Marketing microservice

### [Version 2.7.22](https://spheremall.atlassian.net/browse/M20-80)
## created Categories and EntityGroups resource

### [Version 2.7.21](https://github.com/SphereMall/PHP-MS-Client/wiki/0.-SDK-Changelogs#version-1016)
## Extend attribute entity with attributeTypeId

### [Version 2.7.19.2](https://github.com/SphereMall/PHP-MS-Client/wiki/0.-SDK-Changelogs#version-1016)
## Add CRUD wrapping for CatalogItemAttributes

### [Version 2.7.19.1](https://github.com/SphereMall/PHP-MS-Client/wiki/0.-SDK-Changelogs#version-1016)
## !!! Indexer Microservice version: 2.4.0 +

=======
## Installation

You can install the package manually or by adding it to your `composer.json`:
```
{
  "require": {
      "spheremall/ms-client": "^1.0"
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
* [Multiple Resources](https://github.com/SphereMall/PHP-MS-Client/wiki/1.-Multiple-Resources)
* [Single Resource by ID](https://github.com/SphereMall/PHP-MS-Client/wiki/2.-Single-Resource-by-ID)
* [Limiting and Offsetting Results](https://github.com/SphereMall/PHP-MS-Client/wiki/3.-Limiting-and-Offsetting-Results)
* [Filtering result with specific fields](https://github.com/SphereMall/PHP-MS-Client/wiki/4.-Filtering-result-with-specific-fields)
* [Sorting Results](https://github.com/SphereMall/PHP-MS-Client/wiki/5.-Sorting-Results)
* [Counting Results](https://github.com/SphereMall/PHP-MS-Client/wiki/6.-Counting-Results)
* [Product Resource](https://github.com/SphereMall/PHP-MS-Client/wiki/7.-Product-Resource)
* [Get full](https://github.com/SphereMall/PHP-MS-Client/wiki/7.1.-Get-full)
* [Shop](https://github.com/SphereMall/PHP-MS-Client/wiki/8.-Shop-service)
* [ElasticSearch](https://github.com/SphereMall/PHP-MS-Client/wiki/9.-ElasticSearch)
