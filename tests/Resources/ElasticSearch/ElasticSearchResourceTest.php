<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Grapher;

use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Lib\Filters\ElasticSearch\FullTextFilter;
use SphereMall\MS\Lib\Filters\Grid\ElasticSearchIndexFilter;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class ElasticSearchResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testServiceGetList()
    {
        $index  = new ElasticSearchIndexFilter([Product::class]);
        $filter = new FullTextFilter();
        $filter->index([$index])
               ->keyword('tosti');

        $all = $this->client->elasticSearch()
                            ->filter($filter)
                            ->sort('lastUpdate')
                            ->limit(100)
                            ->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }
    #endregion
}
