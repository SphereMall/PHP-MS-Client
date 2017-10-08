<?php

use SphereMall\MS\Client;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Services\ProductService;

/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 22:09
 */

class ProductServiceTest extends \PHPUnit\Framework\TestCase
{
    private static $gatewayURL = 'http://gateway-main.alpha.spheremall.net:8082';

    public function testProductServiceGetList()
    {
        $client = new Client([
            'gatewayUrl' => static::$gatewayURL,
            'clientId'   => 'API_CLIENT_ID',
            'secretKey'  => 'API_SECRET_KEY'
        ]);

        $productService = new ProductService($client, Product::class);
        $products = $productService->getList();

        $this->assertEquals(2, count($products));

        foreach ($products as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }
}
