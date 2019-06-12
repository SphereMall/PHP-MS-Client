<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 25.02.19
 * Time: 9:34
 */

namespace SphereMall\MS\Tests\Lib\Elastic;

use SphereMall\MS\Lib\Elastic\Interfaces\ElasticBodyElementInterface;
use SphereMall\MS\Lib\Elastic\Queries\{DistanceQuery, ExistsQuery, MatchPhraseQuery, MatchQuery, MultiMatchQuery, RangeQuery, RegexpQuery, TermsQuery, WildCardQuery, TermQuery};
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class QueriesTest extends SetUpResourceTest
{
    #region [with boost]
    public function testWildCardQuery()
    {
        $query = new WildCardQuery('name', 'na*e');

        $this->assertInstanceOf(ElasticBodyElementInterface::class, $query);
        $this->assertEquals($query->toArray(), [
            'wildcard' => [
                'name' => [
                    'value' => 'na*e',
                ],
            ],
        ]);

        $query->setAdditionalParams(['boost' => 2.0]);
        $this->assertEquals($query->toArray(), [
            'wildcard' => [
                'name' => [
                    'value' => 'na*e',
                    'boost' => 2.0,
                ],
            ],
        ]);
    }

    public function testTermsQuery()
    {
        $query = new TermsQuery('name', ['Vasia', 'Petiya']);

        $this->assertInstanceOf(ElasticBodyElementInterface::class, $query);
        $this->assertEquals($query->toArray(), [
            'terms' => [
                'name' => ['Vasia', 'Petiya'],
            ],
        ]);

        $query->setAdditionalParams(['boost' => 2.0]);
        $this->assertEquals($query->toArray(), [
            'terms' => [
                'name'  => ['Vasia', 'Petiya'],
                'boost' => 2.0,
            ],
        ]);
    }

    public function testDistanceQuery()
    {
        $query = new DistanceQuery("pin.location", ['lon' => 11, 'lat' => 10], 10);

        $this->assertInstanceOf(ElasticBodyElementInterface::class, $query);
        $this->assertEquals($query->toArray(), [
            'geo_distance' => [
                'distance'     => "10km",
                'pin.location' => [
                    'lon' => 11,
                    'lat' => 10,
                ],
            ],
        ]);

        $query->setAdditionalParams(['boost' => 2.0]);
        $this->assertEquals($query->toArray(), [
            'geo_distance' => [
                'distance'     => "10km",
                'pin.location' => [
                    'lon' => 11,
                    'lat' => 10,
                ],
                'boost'        => 2.0,
            ],
        ]);
    }

    public function testRangeQuery()
    {
        $query = new RangeQuery('price', ['lte' => 100, 'gte' => 10]);

        $this->assertInstanceOf(ElasticBodyElementInterface::class, $query);
        $this->assertEquals($query->toArray(), [
            'range' => [
                'price' => [
                    'lte' => 100,
                    'gte' => 10,
                ],
            ],
        ]);

        $query->setAdditionalParams(['boost' => 2.0]);
        $this->assertEquals($query->toArray(), [
            'range' => [
                'price' => [
                    'lte'   => 100,
                    'gte'   => 10,
                    'boost' => 2.0,
                ],
            ],
        ]);
    }
    #endregion

    public function testRegexpQuery()
    {
        $query = new RegexpQuery('name', 'd*d');

        $this->assertInstanceOf(ElasticBodyElementInterface::class, $query);
        $this->assertEquals($query->toArray(), [
            'regexp' => [
                'name' => [
                    'value' => "d*d",
                ],
            ],
        ]);

        $query->setAdditionalParams(['flags' => "INTERSECTION|COMPLEMENT|EMPTY"]);

        $this->assertEquals($query->toArray(), [
            'regexp' => [
                'name' => [
                    'value' => "d*d",
                    'flags' => "INTERSECTION|COMPLEMENT|EMPTY",
                ],
            ],
        ]);
    }

    public function testExistsQuery()
    {
        $query = new ExistsQuery("name");

        $this->assertInstanceOf(ElasticBodyElementInterface::class, $query);
        $this->assertEquals($query->toArray(), [
            'exists' => [
                'field' => 'name',
            ],
        ]);
    }

    public function testTermQuery()
    {
        $query = new TermQuery('name', 'Vasia');

        $this->assertInstanceOf(ElasticBodyElementInterface::class, $query);
        $this->assertEquals($query->toArray(), [
            'terms' => [
                'name' => ["Vasia"],
            ],
        ]);
    }

    public function testMultiMatch()
    {
        $query = new MultiMatchQuery("query string", ["title", "name"]);

        $this->assertInstanceOf(ElasticBodyElementInterface::class, $query);
        $this->assertEquals($query->toArray(), [
            "multi_match" => [
                "query"    => "query string",
                "fields"   => ["title", "name"],
                "operator" => "and",
            ],
        ]);

        $query->setAdditionalParams(["type" => 'best_fields']);

        $this->assertEquals($query->toArray(), [
            "multi_match" => [
                "query"    => "query string",
                "fields"   => ["title", "name"],
                "operator" => "and",
                "type"     => "best_fields",
            ],
        ]);
    }

    public function testMatch()
    {
        $query = new MatchPhraseQuery("name", "ddi");

        $this->assertInstanceOf(ElasticBodyElementInterface::class, $query);
        $this->assertEquals($query->toArray(), [
            "match_phrase" => [
                "name" => [
                    "query" => "ddi",
                ],
            ],
        ]);

        $query->setAdditionalParams(['analyzer' => "my_analyzer"]);
        $this->assertEquals($query->toArray(), [
            "match_phrase" => [
                "name" => [
                    "query"    => "ddi",
                    "analyzer" => "my_analyzer",
                ],
            ],
        ]);
    }

    public function testMatchQuery()
    {
        $query = new MatchQuery("name", "dd");

        $this->assertInstanceOf(ElasticBodyElementInterface::class, $query);
        $this->assertEquals($query->toArray(), [
            'match' => [
                'name' => [
                    'query'    => 'dd',
                    'operator' => 'and',
                ],
            ],
        ]);

        $query->setAdditionalParams(['zero_terms_query' => 'all']);

        $this->assertEquals($query->toArray(), [
            'match' => [
                'name' => [
                    'query'            => 'dd',
                    'operator'         => 'and',
                    'zero_terms_query' => 'all',
                ],
            ],
        ]);
    }
}
