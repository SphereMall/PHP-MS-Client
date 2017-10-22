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
use SphereMall\MS\Lib\Filters\FilterOperators;

class BaseResourceTest extends SetUpResourceTest
{
    #region [Properties]
    protected $entityId;
    #endregion

    #region [Set Up]
    protected function setUp()
    {
        parent::setUp();
        $products = $this->client->products();
        $product = $products->limit(10)->all();
        $this->entityId = $product->getByIndex(9)->id;

    }
    #endregion

    #region [Test methods]
    public function testGetList()
    {
        $products = $this->client->products();
        $productList = $products->all();

        $this->assertEquals(10, $productList->count());

        foreach ($productList as $product) {
            $this->assertInstanceOf(Products::class, $product);
        }
    }

    public function testGetSingle()
    {
        $products = $this->client->products();
        $product = $products->get($this->entityId);

        $this->assertEquals($this->entityId, $product->id);
    }

    public function testLimitOffset()
    {
        $products = $this->client->products();

        //Check limit functionality
        $productList = $products->limit(3, 0)->all();
        $this->assertEquals(3, $productList->count());

        $productList = $products->limit(5, 0)->all();
        $this->assertEquals(5, $productList->count());

        $productListOffset1 = $products->limit(2, 0)->all();
        $productListOffset2 = $products->limit(1, 1)->all();
        $this->assertEquals($productListOffset1->getByIndex(1)->id, $productListOffset2->getByIndex(0)->id);
    }

    public function testFields()
    {
        $products = $this->client->products();

        $product = $products->fields(['id', 'title'])->get($this->entityId);
        $this->assertObjectHasAttribute('id', $product);
        $this->assertObjectHasAttribute('title', $product);
        $this->assertObjectNotHasAttribute('price', $product);

        $products = $products->fields(['id', 'price'])->limit(2)->all();
        $this->assertObjectHasAttribute('id', $products->current());
        $this->assertObjectHasAttribute('price', $products->current());
        $this->assertObjectNotHasAttribute('title', $products->current());
    }

    /* public function testFilterFullLike()
     {
         $products = $this->client->products();

         $product = $products->get($this->entityId);
         $titleLike = substr($product->title, 2, 5);

         $productTest = $products
             ->filter(['fullSearch' => $titleLike])
             ->limit(1)
             ->all();

         $this->assertContains($titleLike, $productTest->current()->title);
     }*/

    public function testFilterLike()
    {
        $products = $this->client->products();

        $product = $products->get($this->entityId);
        $titleLike = substr($product->title, 2, 5);

        $productTest = $products
            ->filter([
                'title' => [FilterOperators::LIKE => $titleLike],
            ])
            ->limit(1)
            ->all();

        $this->assertContains($titleLike, $productTest->current()->title);
    }

    public function testFilterLikeLeft()
    {
        $products = $this->client->products();

        $product = $products->get($this->entityId);
        $titleLike = substr($product->title, 5, strlen($product->title) - 1);

        $productTest = $products
            ->filter([
                'title' => [FilterOperators::LIKE_LEFT => $titleLike],
            ])
            ->limit(1)
            ->all();

        $this->assertContains($titleLike, $productTest->current()->title);
    }

    public function testFilterLikeRight()
    {
        $products = $this->client->products();

        $product = $products->get($this->entityId);
        $titleLike = substr($product->title, 0, 5);

        $productTest = $products
            ->filter([
                'title' => [FilterOperators::LIKE_RIGHT => $titleLike],
            ])
            ->limit(1)
            ->all();

        $this->assertContains($titleLike, $productTest->current()->title);
    }

    public function testFilterEqual()
    {
        $products = $this->client->products();

        $product = $products->get($this->entityId);
        $titleLike = $product->title;

        $productTest = $products
            ->filter([
                'title' => [FilterOperators::EQUAL => $titleLike],
            ])
            ->limit(1)
            ->all();

        $this->assertEquals($titleLike, $productTest->current()->title);
    }

    public function testFilterNotEqual()
    {
        $products = $this->client->products();
        $titleLike = 'test';

        $productTest = $products
            ->filter([
                'title' => [FilterOperators::NOT_EQUAL => $titleLike],
            ])
            ->limit(1)
            ->all();

        $this->assertNotEquals($titleLike, $productTest->current()->title);
    }

    public function testFilterGreaterThan()
    {
        $products = $this->client->products();

        $productTest = $products
            ->filter([
                'price' => [FilterOperators::GREATER_THAN => 60000],
            ])
            ->limit(1)
            ->all();

        $this->assertGreaterThan(60000, $productTest->current()->price);
    }

    public function testFilterLessThan()
    {
        $products = $this->client->products();

        $productTest = $products
            ->filter([
                'price' => [FilterOperators::LESS_THAN => 60000],
            ])
            ->limit(1)
            ->all();

        $this->assertLessThan(60000, $productTest->current()->price);
    }

    public function testFilterGreaterOrEqualThan()
    {
        $products = $this->client->products();

        $productTest = $products
            ->filter([
                'price' => [FilterOperators::GREATER_THAN_OR_EQUAL => 60000],
            ])
            ->limit(1)
            ->all();

        $this->assertGreaterThanOrEqual(60000, $productTest->current()->price);
    }

    public function testFilterLessOrEqualThan()
    {
        $products = $this->client->products();

        $productTest = $products
            ->filter([
                'price' => [FilterOperators::LESS_THAN_OR_EQUAL => 60000],
            ])
            ->limit(1)
            ->all();

        $this->assertLessThanOrEqual(60000, $productTest->current()->price);
    }

    public function testFilterIsNull()
    {
        $products = $this->client->products();

        $productTest = $products
            ->filter([
                'titleMask' => [FilterOperators::IS_NULL => 'null'],
            ])
            ->limit(1)
            ->all();

        $this->assertNull($productTest->current()->titleMask);
    }

    public function testIn()
    {
        $products = $this->client->products();
        $productList = $products->limit(2)->all();

        $productsTest = $products
            ->in('title', [$productList->current()->title, $productList->getByIndex(1)->title])
            ->all();

        $this->assertCount(2, $productsTest);

        $this->assertEquals($productList->current()->title, $productsTest->current()->title);
        $productList->next();
        $productsTest->next();
        $this->assertEquals($productList->current()->title, $productsTest->current()->title);
    }
    #endregion
}
