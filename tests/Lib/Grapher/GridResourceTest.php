<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/29/2017
 * Time: 5:16 PM
 */

namespace SphereMall\MS\Tests\Lib\Grapher;

use SphereMall\MS\Entities\Address;
use SphereMall\MS\Entities\Document;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Lib\Shop\Basket;
use SphereMall\MS\Lib\Shop\Delivery;
use SphereMall\MS\Lib\Shop\OrderFinalized;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class GridResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testGrid()
    {
        $grid = $this->client->grid()->all();

        foreach ($grid as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testGridFilter()
    {
        $grid = $this->client->grid()
            ->filter(['entity' => 'product'])
            ->all();

        foreach ($grid as $item) {
            $this->assertInstanceOf(Product::class, $item);
        }

        $grid = $this->client->grid()
            ->filter(['entity' => 'document'])
            ->all();

        foreach ($grid as $item) {
            $this->assertInstanceOf(Document::class, $item);
        }
    }

    public function testGridCount()
    {
        $amount = $this->client->grid()
            ->filter(['entity' => 'product'])
            ->count();

        $this->assertGreaterThan(0, $amount);

    }
    #endregion
}
