<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Grapher;

use SphereMall\MS\Entities\Document;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Lib\Filters\Grid\EntityFilter;
use SphereMall\MS\Lib\Filters\Grid\GridFilter;
use SphereMall\MS\Lib\Http\Meta;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class GridResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testServiceGetList()
    {
        $all = $this->client->grid()->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testGrid()
    {
        $grid = $this->client->grid()->all();

        foreach ($grid as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testGridFilter()
    {
        $filter = new GridFilter();
        $filter->elements([new EntityFilter(['product'])]);

        $this->assertInstanceOf(GridFilter::class, $filter);

        $grid = $this->client->grid()
            ->filter($filter)
            ->all();

        foreach ($grid as $item) {
            $this->assertInstanceOf(Product::class, $item);
        }

        $filter = new GridFilter();
        $filter->elements([new EntityFilter(['document'])]);
        $grid = $this->client->grid()
            ->filter($filter)
            ->all();

        foreach ($grid as $item) {
            $this->assertInstanceOf(Document::class, $item);
        }
    }

    public function testGridCount()
    {
        $filter = new GridFilter();
        $filter->elements([new EntityFilter(['product'])]);

        $amount = $this->client->grid()
            ->filter($filter)
            ->count();

        $this->assertGreaterThan(0, $amount);

    }

    public function testServiceGetWithMeta()
    {
        $all = $this->client->grid()->withMeta()->all();

        $this->assertInstanceOf(Meta::class, $all->getMeta());

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testGridFacets()
    {
        $all = $this->client->grid()->facets();

        foreach ($all as $items) {
            foreach ($items as $item) {
                if (is_object($item)) {
                    $this->assertInstanceOf(Entity::class, $item);
                }
            }
        }
    }

    #endregion
}
