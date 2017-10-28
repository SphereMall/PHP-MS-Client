<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources;

use SphereMall\MS\Entities\Product;

class ProductsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testProductServiceGetList()
    {
        $products = $this->client->products();
        $productList = $products->all();

        $this->assertEquals(10, $productList->count());

        $ids[] = $productList->current()->id;
        $productList = $products->ids($ids)->all();
        $this->assertEquals(1, $productList->count());
        $this->assertEquals($ids, $products->getIds());

        foreach ($productList as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }

    public function testProductFull()
    {
        $products = $this->client
            ->products()
            ->limit(2)
            ->full();

        $this->assertEquals(2, $products->count());

        $products = $this->client
            ->products()
            ->limit(1)
            ->ids([6351])
            ->full();

        $this->assertEquals(6351, $products->current()->id);

        $products = $this->client
            ->products()
            ->full(6351);

        $this->assertEquals(6351, $products->current()->id);

        $products = $this->client
            ->products()
            ->full('limoen-komkommer-fruitwater');

        $this->assertEquals('limoen-komkommer-fruitwater', $products->current()->urlCode);
        $this->assertCount(1, $products);

        $this->assertNotNull($products->current()->attributes);
        $this->assertNotNull($products->current()->media);
        $this->assertNotNull($products->current()->brand);
        $this->assertNotNull($products->current()->functionalName);

    }
    #endregion
}
