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
use SphereMall\MS\Lib\Filters\Filter;
use SphereMall\MS\Lib\Filters\FilterOperators;
use SphereMall\MS\Lib\Specifications\Basic\IsVisible;

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
        $this->entityId = $product[9]->id;

    }
    #endregion

    #region [Test methods]
    public function testGetList()
    {
        $products = $this->client->products();
        $productList = $products->all();

        $this->assertEquals(10, count($productList));

        foreach ($productList as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }

    public function testGetSingle()
    {
        $products = $this->client->products();
        $product = $products->get($this->entityId);

        $this->assertEquals($this->entityId, $product->id);
    }

    public function testGetFirst()
    {
        $product = $this->client->products()->first();
        $this->assertInstanceOf(Product::class, $product);
    }

    /**
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testCreateAndDelete()
    {
        $user = $this->client->users()
            ->create(['name' => 'new user']);

        $this->assertEquals('new user', $user->name);

        $this->client->users()->delete($user->id);
    }

    /**
     * @expectedException \SphereMall\MS\Exceptions\EntityNotFoundException
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testDeleteException()
    {

        $this->client->users()->delete(385635638475634);
    }

    /**
     * @expectedException \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testCreateException()
    {
        $this->client->users()
            ->create(['email' => 'test_unique@test.com']);
    }

    /**
     * @expectedException \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testUpdateException()
    {
        $this->client->users()
            ->update(123234234234,['email' => 'updated']);
    }

    /**
     * @expectedException \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testMultiUpdateException()
    {
        $this->client->users()
                     ->multiUpdate([
                         ['id' => 123234234234, 'email' => 'updated'],
                         ['id' => 1232342342349, 'email' => 'updated2']
                     ]);
    }

    /**
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testCreateAndUpdateAndDelete()
    {
        $user = $this->client->users()
            ->create(['name' => 'new user name']);

        $this->assertEquals('new user name', $user->name);

        $user = $this->client->users()
            ->update($user->id, ['name' => 'updated name']);

        $this->assertEquals('updated name', $user->name);

        $this->client->users()->delete($user->id);
    }

    /**
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testMultiUpdate()
    {
        $user1 = $this->client->users()
                              ->create(['name' => 'new user name1']);

        $user2 = $this->client->users()
                              ->create(['name' => 'new user name2']);

        $users = $this->client->users()
                              ->multiUpdate([
                                  ['id' => $user1->id, 'name' => 'updated name1'],
                                  ['id' => $user2->id, 'name' => 'updated name2']
                              ]);

        foreach ($users as $user) {
            $updatedName = '';

            switch ($user->id) {
                case $user1->id :
                    $updatedName = 'updated name1';
                    break;
                case $user2->id :
                    $updatedName = 'updated name2';
                    break;

            }

            $this->assertEquals($updatedName, $user->name);
        }

        $this->client->users()->delete($user1->id);
        $this->client->users()->delete($user2->id);
    }

    public function testLimitOffsetAndAmountOfCalls()
    {
        $products = $this->client->products();

        //Check limit functionality
        $productList = $products->limit(3, 0)->all();
        $this->assertEquals(3, count($productList));
        $this->assertEquals(3, $products->getLimit());
        $this->assertEquals(0, $products->getOffset());

        $productList = $products->limit(5, 0)->all();
        $this->assertEquals(5, count($productList));
        $this->assertEquals(5, $products->getLimit());
        $this->assertEquals(0, $products->getOffset());

        $productListOffset1 = $products->limit(2, 0)->all();
        $this->assertEquals(2, $products->getLimit());
        $this->assertEquals(0, $products->getOffset());

        $productListOffset2 = $products->limit(1, 1)->all();
        $this->assertEquals(1, $products->getLimit());
        $this->assertEquals(1, $products->getOffset());

        $this->assertEquals($productListOffset1[1]->id, $productListOffset2[0]->id);

        $stat = $this->client->getCallsStatistic();
        $this->assertEquals(5, $stat['amount']);
    }

    public function testSetIds()
    {
        $products = $this->client->products()->ids([1, 2, 4]);
        $this->assertEquals([1, 2, 4], $products->getIds());
    }

    public function testFields()
    {
        $products1 = $this->client->products();

        $product = $products1->fields(['id', 'title'])->get($this->entityId);
        $this->assertNotNull($product->id);
        $this->assertNotNull($product->title);
        $this->assertNull($product->price);

        $this->assertEquals(['id', 'title'], $products1->getFields());

        $products2 = $this->client->products();
        $products = $products2->fields(['id', 'price'])->limit(2)->all();
        $this->assertNotNull($products[0]->id);
        $this->assertNotNull($products[0]->price);
        $this->assertNull($products[0]->title);
        $this->assertEquals(['id', 'price'], $products2->getFields());
    }

    public function testGetFilter()
    {
        $products = $this->client->products()->filter([
            'title' => [FilterOperators::LIKE => 'test']
        ]);

        $this->assertEquals(new Filter([
            'title' => [FilterOperators::LIKE => 'test']
        ]), $products->getFilter());
    }

    public function testMultipleFilter()
    {
        $products = $this->client->products();

        $product = $products->get($this->entityId);
        $titleLike = substr($product->title, 2, 5);

        $productTest = $products
            ->filter([
                'title' => [FilterOperators::LIKE => $titleLike],
                'price' => [FilterOperators::GREATER_THAN_OR_EQUAL => 100],
            ])
            ->limit(1)
            ->all();

        $this->assertContains($titleLike, $productTest[0]->title);
        $this->assertGreaterThanOrEqual(100, $productTest[0]->price);
    }

    public function testFilterSpecification()
    {
        $products = $this->client->products()
            ->filter(new IsVisible())
            ->limit(1)
            ->all();

        $this->assertEquals(1, $products[0]->visible);
    }

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

        $this->assertContains($titleLike, $productTest[0]->title);
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

        $this->assertContains($titleLike, $productTest[0]->title);
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

        $this->assertContains($titleLike, $productTest[0]->title);
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

        $this->assertEquals($titleLike, $productTest[0]->title);
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

        $this->assertNotEquals($titleLike, $productTest[0]->title);
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

        $this->assertGreaterThan(60000, $productTest[0]->price);
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

        $this->assertLessThan(60000, $productTest[0]->price);
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

        $this->assertGreaterThanOrEqual(60000, $productTest[0]->price);
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

        $this->assertLessThanOrEqual(60000, $productTest[0]->price);
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

        $this->assertNull($productTest[0]->titleMask);
    }

    public function testIn()
    {
        $products = $this->client->products();
        $productList = $products->limit(2)->all();

        $productsTest = $products
            ->in('title', [$productList[0]->title, $productList[1]->title])
            ->all();

        $this->assertCount(2, $productsTest);

        $this->assertEquals($productList[0]->title, $productsTest[0]->title);
        $this->assertEquals($productList[1]->title, $productsTest[1]->title);
    }

    public function testSort()
    {
        $products1 = $this->client->products();
        $productList1 = $products1->limit(2)->sort('title')->all();
        $this->assertEquals(['title'], $products1->getSort());

        $products2 = $this->client->products();
        $productList2 = $products2->limit(2)->sort('-title')->all();
        $this->assertEquals(['-title'], $products2->getSort());

        $this->assertCount(2, $productList1);
        $this->assertCount(2, $productList2);

    }

    public function testCount()
    {
        $products1 = $this->client->products();
        $productCount = $products1->filter([
            'price' => [FilterOperators::GREATER_THAN_OR_EQUAL => 60000],
        ])
            ->limit(2)
            ->sort('title')
            ->count();
        $this->assertEquals(2, $productCount);
    }

    public function testCollectionAsArray()
    {
        $products1 = $this->client->products();
        $products = $products1
            ->limit(2)
            ->all();

        $this->assertTrue(is_array($products));
    }
    #endregion
}
