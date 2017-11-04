<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/8/2017
 * Time: 4:52 PM
 */
namespace SphereMall\MS\Tests;

use SphereMall\MS\Client;
use SphereMall\MS\Resources\ProductsResource;
use SphereMall\MS\Resources\Resource;

class ClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Exception
     */
    public function testClientObjectCreatedNotConfigured()
    {
        $client = new Client();
    }

    public function testClientObjectCreatedWithConfiguration()
    {
        $client = new Client([
            'gatewayUrl' => API_GATEWAY_URL,
            'clientId'   => API_CLIENT_ID,
            'secretKey'  => API_SECRET_KEY,
            'version'    => API_VERSION,
        ]);

        $this->assertEquals(API_GATEWAY_URL, $client->getGatewayUrl());
        $this->assertEquals(API_CLIENT_ID, $client->getClientId());
        $this->assertEquals(API_SECRET_KEY, $client->getSecretKey());
        $this->assertEquals(API_VERSION, $client->getVersion());
    }

    public function testClientCallService()
    {
        $client = new Client([
            'gatewayUrl' => API_GATEWAY_URL,
            'clientId'   => API_CLIENT_ID,
            'secretKey'  => API_SECRET_KEY,
            'version'    => API_VERSION,
        ]);

        $productService = $client->products();

        $this->assertInstanceOf(Resource::class, $productService);
        $this->assertInstanceOf(ProductsResource::class, $productService);
    }
}
