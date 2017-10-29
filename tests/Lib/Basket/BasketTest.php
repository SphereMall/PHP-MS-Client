<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/29/2017
 * Time: 5:16 PM
 */

namespace SphereMall\MS\Tests\Lib\Basket;

use SphereMall\MS\Lib\Basket\Basket;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class BasketTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testBasketCreate()
    {
        $basket = $this->client->basket();
        $this->assertInstanceOf(Basket::class, $basket);

        $product = $this->client->products()->limit(1)->all()->current();
        $basket->add([
            [
                'id' => $product->id,
                'amount'    => 1,
            ],
        ]);

        $this->assertCount(1, $basket->getItems());
    }

    public function testGetExistingBasket()
    {
        $client = clone $this->client;
        $basket = $client->basket(570);
        $this->assertInstanceOf(Basket::class, $basket);

        $this->assertCount(1, $basket->getItems());
        $this->assertEquals(1, $basket->getId());
    }
    #endregion
}
