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
    /**
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testProductServiceGetList()
    {
        $products = $this->client->products();
        $productList = $products->all();

        $this->assertEquals(10, count($productList));

        foreach ($productList as $product) {
            $this->assertInstanceOf(Products::class, $product);
        }

        $ids[] = $productList[0]->id;
        $productList = $products->ids($ids)->all();
        $this->assertEquals(1, count($productList));
    }
    #endregion
}
