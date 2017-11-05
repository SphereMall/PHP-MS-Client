<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/29/2017
 * Time: 5:16 PM
 */

namespace SphereMall\MS\Tests\Lib\Shop;

use SphereMall\MS\Entities\Address;
use SphereMall\MS\Lib\Shop\Basket;
use SphereMall\MS\Lib\Shop\Delivery;
use SphereMall\MS\Lib\Shop\OrderFinalized;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class OrderTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testGetExistingBasket()
    {
        $basket = $this->client->basket();
        $this->assertInstanceOf(Basket::class, $basket);

        $product = $this->client->products()->limit(1)->all()->current();
        $basket->add([
            'products' => [
                [
                    'id'     => $product->id,
                    'amount' => 1,
                ],
            ],
        ]);

        $this->assertCount(1, $basket->items);

        $basketId = $basket->getId();
        $orderId = 'test_' . $basket->getId();
        $basket->update(['statusId' => 2, 'orderId' => $orderId]);

        $client = clone $this->client;
        $order = $client->orders()
            ->byOrderId($orderId);

        $this->assertInstanceOf(OrderFinalized::class, $order);
        $this->assertCount(1, $order->items);

        $this->assertEquals($basketId, $order->getId());
    }
    #endregion
}
