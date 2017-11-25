<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Lib\Async;

use SphereMall\MS\Client;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Lib\Async\AsyncContainer;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class BaseAsyncTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testAsyncCalls()
    {
        $products = $this->client->products();
        $product = $products->limit(1)->all();

        $time1 = microtime(true);
        $ac = new AsyncContainer($this->client);

        $ac->setCall('oneProduct', function (Client $client) {
            return $client->products()->limit(1)->all();
        });

        $ac->setCall('singleProduct', function (Client $client) use ($product) {
            return $client->products()->get($product[0]->id);
        });

        $ac->setCall('list1', function (Client $client) {
            return $client->products()->limit(2)->all();
        });
        $ac->setCall('list2', function (Client $client) {
            return $client->products()->limit(10)->all();
        });
        $ac->setCall('list3', function (Client $client) {
            return $client->products()->limit(15)->all();
        });
        $ac->setCall('list4', function (Client $client) {
            return $client->products()->limit(20)->all();
        });

        $ac->setCall('first', function (Client $client) {
            return $client->products()->first();
        });

        $data = $ac->call();

        $resTime = round((microtime(true) - $time1), 3);
        $this->assertCount(1, $data['oneProduct']);
        $this->assertEquals($product[0]->id, $data['singleProduct']->id);
        $this->assertCount(2, $data['list1']);
        $this->assertCount(10, $data['list2']);
        $this->assertCount(15, $data['list3']);
        $this->assertCount(20, $data['list4']);

        $this->assertInstanceOf(Product::class, $data['first']);
    }

    public function testNotAsyncCalls()
    {
        $time1 = microtime(true);

        $oneProduct = $this->client->products()->limit(1)->all();

        $list1 = $this->client->products()->limit(2)->all();
        $list2 = $this->client->products()->limit(10)->all();
        $list3 = $this->client->products()->limit(15)->all();
        $list4 = $this->client->products()->limit(20)->all();

        $resTime = round((microtime(true) - $time1), 3);
        $this->assertCount(1, $oneProduct);
        $this->assertCount(2, $list1);
        $this->assertCount(10, $list2);
        $this->assertCount(15, $list3);
        $this->assertCount(20, $list4);
    }

    public function testAsyncAndNotAsyncCalls()
    {
        $ac = new AsyncContainer($this->client);

        $ac->setCall('oneProduct', function (Client $client) {
            return $client->products()->limit(1)->all();
        });

        $data = $ac->call();

        $oneProduct = $this->client->products()->limit(1)->all();

        $this->assertEquals($data['oneProduct'], $oneProduct);

        $ac->setCall('oneProduct1', function (Client $client) {
            return $client->products()->limit(1)->all();
        });

        $data = $ac->call();

        $oneProduct1 = $this->client->products()->limit(1)->all();

        $this->assertEquals($data['oneProduct1'], $oneProduct1);
    }
    #endregion
}
