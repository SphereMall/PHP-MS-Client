<?php
/**
 * Created by SergeyBondarchuk.
 * 11.01.2019 13:23
 */

namespace SphereMall\MS\Tests\Resources\ElasticSearch;


use SphereMall\MS\Lib\FilterParams\ElasticIndexer\EntityFilterParams;
use SphereMall\MS\Lib\Filters\ElasticIndexer\EntitiesFilter;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class ElasticIndexerResourceTest extends SetUpResourceTest
{
    public function testImportMethod()
    {
        $condition = ['visible' => ['e' => 1]];
        $entities = ['products', 'documents', 'pages'];
        $params = [];

        foreach ($entities as $entity) {
            $params[] = new EntityFilterParams($entity, $condition);
        }

        $filter = $params ? new EntitiesFilter($params) : [];

        $indexes = $this->client
            ->elasticIndexer()
            ->filter($filter)
            ->limit(1)
            ->import();

        $this->assertCount(4, $indexes);


        foreach ($indexes as $index) {
            if($index->type == 'all') {
                continue;
            }

            $indexFilter = (new EntitiesFilter([
                new EntityFilterParams($index->type)
            ]))->addFilter('hash', $index->hash, null);

            $i = $this->client
                ->elasticIndexer()
                ->filter($indexFilter)
                ->limit(1, 1)
                ->import();

            $this->assertCount(2, $i);
            $this->assertEquals($i[0]->hash, $index->hash);
        }
    }
}