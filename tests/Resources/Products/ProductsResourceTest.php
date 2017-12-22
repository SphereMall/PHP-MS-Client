<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Products;

use SphereMall\MS\Entities\Product;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class ProductsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testServiceGetList()
    {
        $products = $this->client->products();
        $productArray = $products->all();
        $productList = new Collection($productArray);

        $this->assertEquals(10, $productList->count());

        $ids[] = $productList->current()->id;
        $productArray = $products->ids($ids)->all();
        $productList = new Collection($productArray);

        $this->assertEquals(1, $productList->count());
        $this->assertEquals($ids, $products->getIds());

        foreach ($productList as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }

    public function testServiceGetListWithMeta()
    {
        $products = $this->client->products();
        $productCollection = $products->withMeta()->all();

        $this->assertInstanceOf(Collection::class, $productCollection);
    }

    public function testProductFull()
    {
        $products = $this->client
            ->products()
            ->limit(2)
            ->full();

        $this->assertEquals(2, count($products));

        $products = $this->client
            ->products()
            ->limit(1)
            ->ids([6351])
            ->full();

        $this->assertEquals(6351, $products[0]->id);

        $products = $this->client
            ->products()
            ->full(6351);

        $this->assertEquals(6351, $products[0]->id);

        $products = $this->client
            ->products()
            ->full('limoen-komkommer-fruitwater');

        $this->assertEquals('limoen-komkommer-fruitwater', $products[0]->urlCode);
        $this->assertCount(1, $products);

        $this->assertNotNull($products[0]->attributes);
        $this->assertNotNull($products[0]->media);
        $this->assertNotNull($products[0]->brand);
        $this->assertNotNull($products[0]->functionalName);

    }

    public function testAttributeHelpMethods()
    {
        $products = $this->client->products()
            ->limit(1)
            ->full();

        $attribute = $products[0]->getAttributeByCode('test-html');
        $this->assertEquals('test-html', $attribute->code);

        $attributeValue = $products[0]->getFirstValueByAttributeCode('test-html');
        $this->assertEquals('fghfghfgh', $attributeValue->value);

    }
    #endregion
}
