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

class BaseResourceTest extends SetUpResourceTest
{
    #region [Properties]
    protected $entityId;
    #endregion

    #region [Set Up]
    /**
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    protected function setUp()
    {
        parent::setUp();
        $products = $this->client->products();
        $product = $products->limit(1)->all();
        $this->entityId = $product[0]->id;

    }
    #endregion

    #region [Test methods]
    /**
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testGetList()
    {
        $products = $this->client->products();
        $productList = $products->all();

        $this->assertEquals(10, count($productList));

        foreach ($productList as $product) {
            $this->assertInstanceOf(Products::class, $product);
        }
    }

    /**
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testGetSingle()
    {
        $products = $this->client->products();
        $product = $products->get($this->entityId);

        $this->assertEquals($this->entityId, $product->id);
    }

    /**
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testLimitOffset()
    {
        $products = $this->client->products();

        //Check limit functionality
        $productList = $products->limit(3, 0)->all();
        $this->assertEquals(3, count($productList));

        $productList = $products->limit(5, 0)->all();
        $this->assertEquals(5, count($productList));

        $productListOffset1 = $products->limit(2, 0)->all();
        $productListOffset2 = $products->limit(1, 1)->all();
        $this->assertEquals($productListOffset1[1]->id, $productListOffset2[0]->id);
    }
    /**
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testFields()
    {
        $products = $this->client->products();

        $product = $products->fields(['id', 'title'])->get($this->entityId);
        $this->assertObjectHasAttribute('id', $product);
        $this->assertObjectHasAttribute('title', $product);
        $this->assertObjectNotHasAttribute('price', $product);

        $products = $products->fields(['id', 'price'])->limit(2)->all();
        $this->assertObjectHasAttribute('id', $products[0]);
        $this->assertObjectHasAttribute('price', $products[0]);
        $this->assertObjectNotHasAttribute('title', $products[0]);
    }
    #endregion
}
