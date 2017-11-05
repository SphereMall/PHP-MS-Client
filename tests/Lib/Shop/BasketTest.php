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
            'products' => [
                [
                    'id'     => $product->id,
                    'amount' => 1,
                ],
            ],
        ]);

        $this->assertCount(1, $basket->items);
    }

    public function testGetExistingBasket()
    {
        $client = clone $this->client;
        $basket = $client->basket(570);
        $this->assertInstanceOf(Basket::class, $basket);

        $this->assertCount(1, $basket->items);
        $this->assertEquals(570, $basket->getId());
    }

    public function testItemRemoveFromBasket()
    {
        $basket = $this->client->basket();
        $this->assertInstanceOf(Basket::class, $basket);

        $products = $this->client->products()->limit(2)->all();
        $params = array_map(function ($product) {
            return [
                'id'     => $product->id,
                'amount' => 1,
            ];
        }, $products->asArray());

        $basket->add(['products' => $params]);

        $this->assertCount(2, $basket->items);

        $deleteParams = ['products' => [['id' => $products->current()->id]]];
        $basket->remove($deleteParams);
        $this->assertCount(1, $basket->items);
    }

    public function testChangeAmount()
    {
        $client = clone $this->client;
        $basket = $client->basket();
        $this->assertInstanceOf(Basket::class, $basket);

        $products = $this->client->products()->limit(1)->all();
        $params = array_map(function ($product) {
            return [
                'id'     => $product->id,
                'amount' => 1,
            ];
        }, $products->asArray());

        $basket->add(['products' => $params]);

        $item = $basket->items->current();
        $this->assertEquals(1, $item->amount);
        $this->assertCount(1, $basket->items);

        $itemParams = [
            'products' => [
                [
                    'id'     => $item->product->id,
                    'amount' => 3,
                ],
            ],
        ];

        $basket->update($itemParams);

        $item = $basket->items->current();
        $this->assertEquals(3, $item->amount);
        $this->assertCount(1, $basket->items);

        $itemParams = [
            'products' => [
                [
                    'id'     => $item->product->id,
                    'amount' => 2,
                ],
            ],
        ];

        $basket->update($itemParams);

        $item = $basket->items->current();
        $this->assertEquals(2, $item->amount);
        $this->assertCount(1, $basket->items);
    }

    public function testDeliveryMethod()
    {
        $client = clone $this->client;
        $basket = $client->basket();
        $this->assertInstanceOf(Basket::class, $basket);

        $products = $this->client->products()->limit(1)->all();
        $params = array_map(function ($product) {
            return [
                'id'     => $product->id,
                'amount' => 1,
            ];
        }, $products->asArray());

        $basket->add(['products' => $params]);

        $deliveryProviders = $this->client->deliveryProviders()->limit(1)->all();
        $basket->setDelivery(new Delivery($deliveryProviders->current()))
            ->update();

        $client = clone $this->client;
        $basket = $client->basket($basket->getId());
        $this->assertInstanceOf(Delivery::class, $basket->getDelivery());
        $this->assertEquals($deliveryProviders->current()->id, $basket->getDelivery()->id);
    }

    public function testSetShipping()
    {
        $client = clone $this->client;
        $basket = $client->basket();
        $this->assertInstanceOf(Basket::class, $basket);

        $address = new Address([
            'name'    => 'test',
            'surname' => 'test',
        ]);
        $basket->setShippingAddress($address)
            ->update();

        $this->assertEquals($basket->getShippingAddress()->name, $address->name);
        $this->assertEquals($basket->getShippingAddress()->surname, $address->surname);
    }

    public function testSetBilling()
    {
        $client = clone $this->client;
        $basket = $client->basket();
        $this->assertInstanceOf(Basket::class, $basket);

        $address = new Address([
            'name'    => 'test1',
            'surname' => 'test1',
        ]);
        $basket->setBillingAddress($address)
            ->update();

        $this->assertEquals($basket->getBillingAddress()->name, $address->name);
        $this->assertEquals($basket->getBillingAddress()->surname, $address->surname);
    }

    public function testSetPaymentMethod()
    {
        $client = clone $this->client;
        $basket = $client->basket();
        $this->assertInstanceOf(Basket::class, $basket);

        $paymentCollection = $this->client->paymentMethods()->limit(1)->all();
        $basket->setPaymentMethod($paymentCollection->current()->id)
            ->update();

        $this->assertEquals($basket->getPaymentMethod(), $paymentCollection->current()->id);
    }
    #endregion
}
