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
use SphereMall\MS\Lib\Filters\ElasticSearch\FullTextFilter;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class ElasticSearchResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testServiceGetList()
    {
        $filter = new FullTextFilter();
        $filter->index('sm-products-test')
               ->keyword('tosti')
               ->order(['lastUpdate' => ['order' => 'asc']]);

        $all = $this->client->elasticSearch()
                            ->filter($filter)
                            ->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }
    #endregion
}
