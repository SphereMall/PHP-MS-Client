<?php

use SphereMall\MS\Client;
use SphereMall\MS\Entities\Products;
use SphereMall\MS\Resources\ProductsResource;

/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

class ProductsResourceTest extends \PHPUnit\Framework\TestCase
{
    private static $gatewayURL = 'http://gateway-main.alpha.spheremall.net:8082';

    public function testProductServiceGetList()
    {
        $client = new Client([
            'gatewayUrl' => static::$gatewayURL,
            'clientId'   => 'API_CLIENT_ID',
            'secretKey'  => 'API_SECRET_KEY'
        ]);

        $products = new ProductsResource($client);
        $productList = $products->all();

        $this->assertEquals(10, count($productList));

        foreach ($productList as $product) {
            $this->assertInstanceOf(Products::class, $product);
        }

        //Check limit functionality
        $productList = $products->limit(0,3)->all();
        $this->assertEquals(3, count($productList));

        $productList = $products->limit(0,5)->all();
        $this->assertEquals(5, count($productList));

        $ids[] = $productList[0]->id;
        $productList = $products->ids($ids)->all();
        $this->assertEquals(1, count($productList));
    }
}
