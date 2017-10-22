<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */
namespace SphereMall\MS\Tests\Resources;

use SphereMall\MS\Entities\Products;

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

        foreach ($productList as $product) {
            $this->assertInstanceOf(Products::class, $product);
        }
    }
    #endregion
}
