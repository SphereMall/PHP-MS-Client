<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\ElasticSearch;

use SphereMall\MS\Entities\Document;
use SphereMall\MS\Entities\Page;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Lib\FilterParams\ElasticSearch\AttributeFilterParams;
use SphereMall\MS\Lib\FilterParams\ElasticSearch\AttributeValuesFilterParams;
use SphereMall\MS\Lib\FilterParams\ElasticSearch\AttributeValuesIdFilterParams;
use SphereMall\MS\Lib\FilterParams\ElasticSearch\IndexFilterParams;
use SphereMall\MS\Lib\FilterParams\ElasticSearch\TermsFilterParams;
use SphereMall\MS\Lib\Filters\ElasticSearch\BodyQueryFilter;
use SphereMall\MS\Lib\Filters\ElasticSearch\ElasticSearchIndexFilter;
use SphereMall\MS\Lib\Filters\ElasticSearch\FullTextFilter;
use SphereMall\MS\Lib\Filters\ElasticSearch\SearchFilter;
use SphereMall\MS\Lib\Filters\ElasticSearch\TermsFilter;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class ElasticSearchResourceTest extends SetUpResourceTest
{
    public function testElasticSearchIndexFilter()
    {
        $indexes = ['sm-products', 'sm-documents', 'sm-pages'];

        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class, Document::class, Page::class]));
        $this->assertAttributeEquals('index', 'name', $index);
        $this->assertAttributeEquals($indexes, 'values', $index);
        $this->assertAttributeEquals(null, 'langCodes', $index);
    }

    public function testTermFilter()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class]));

        $field  = "brandId";
        $values = [333, 50];

        $brandTerm = new TermsFilter(new TermsFilterParams($field, $values));
        $this->assertAttributeEquals('terms', 'name', $brandTerm);
        $this->assertAttributeEquals([$field => $values], 'values', $brandTerm);
        $this->assertAttributeEquals(['field' => $field], 'facets', $brandTerm);
        $this->assertAttributeEquals(null, 'langCodes', $brandTerm);

        $filter = (new SearchFilter())->index([$index])->elements([$brandTerm])->getSearchFilters();

        $this->assertEquals("sm-products", $filter['index']);
        $this->assertEquals(['scope'], $filter["_source"]);
        $this->assertEquals([
            "query" => [
                "bool" => [
                    "filter" => [
                        [
                            "terms" => [
                                $field => $values,
                            ],
                        ],
                    ],
                ],
            ],
        ], $filter['body']);
    }

    public function testTermFilterWithAttributes()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class]));

        $attrId        = "color";
        $attrValuesIds = [1, 2];
        $attrValues    = ["n", "y"];

        $attrTerm = new TermsFilter(new AttributeFilterParams($attrId, new AttributeValuesIdFilterParams($attrValuesIds)));
        $this->assertAttributeEquals("terms", "name", $attrTerm);
        $this->assertAttributeEquals(null, "langCodes", $attrTerm);
        $this->assertAttributeEquals(["field" => "{$attrId}_attr.valueId"], "facets", $attrTerm);
        $this->assertAttributeEquals(["{$attrId}_attr.valueId" => $attrValuesIds], "values", $attrTerm);

        $filter = (new SearchFilter())->index([$index])->elements([$attrTerm])->getSearchFilters();

        $this->assertEquals("sm-products", $filter['index']);
        $this->assertEquals(['scope'], $filter["_source"]);

        $this->assertEquals([
            "query" => [
                "bool" => [
                    "filter" => [
                        [
                            "terms" => [
                                "{$attrId}_attr.valueId" => $attrValuesIds,
                            ],
                        ],
                    ],
                ],
            ],
        ], $filter['body']);

        $attrTerm = new TermsFilter(new AttributeFilterParams($attrId, new AttributeValuesFilterParams($attrValues)));

        $filter = (new SearchFilter())->index([$index])->elements([$attrTerm])->getSearchFilters();

        $this->assertEquals([
            "query" => [
                "bool" => [
                    "filter" => [
                        [
                            "terms" => [
                                "{$attrId}_attr.attributeValue" => $attrValues,
                            ],
                        ],
                    ],
                ],
            ],
        ], $filter['body']);
    }

    public function testFullTextSearch()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class]));

        $field   = "title";
        $keyword = "test";

        $filter = (new FullTextFilter())->index([$index])->keyword($keyword)->setFields([$field]);

        $this->assertAttributeEquals($keyword, "keyword", $filter);
        $this->assertAttributeEquals([$field], "fields", $filter);
        $this->assertAttributeEquals(["sm-products"], "indexes", $filter);

        $query = (string)$filter;

        $this->assertEquals(json_encode([
            "index" => "sm-products",
            "body"  => [
                "query" => [
                    "bool" => [
                        "must" => [
                            "multi_match" => [
                                "fields" => [
                                    $field,
                                ],
                                "query"  => $keyword,
                            ],
                        ],
                    ],
                ],
            ],
        ]), $query);

    }

    public function testMultiTermsFilter()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class]));

        $attrId     = 1;
        $attrValues = [1, 2];

        $attrTerm = new TermsFilter(new AttributeFilterParams($attrId, new AttributeValuesIdFilterParams($attrValues)));

        $field  = "brandId";
        $values = [333, 50];

        $brandTerm = new TermsFilter(new TermsFilterParams($field, $values));

        $filter = (new SearchFilter())->index([$index])->elements([$brandTerm, $attrTerm])->getSearchFilters();

        $this->assertEquals("sm-products", $filter['index']);
        $this->assertEquals(['scope'], $filter["_source"]);
        $this->assertEquals([
            "query" => [
                "bool" => [
                    "filter" => [
                        [
                            "terms" => [
                                $field => $values,
                            ],
                        ],
                        [
                            "terms" => [
                                "{$attrId}_attr.valueId" => $attrValues,
                            ],
                        ],
                    ],
                ],
            ],
        ], $filter['body']);
    }

    public function testMultiMustFiltersSearch()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class]));

        $query = [
            'bool' => [
                'must' => [
                    [
                        "terms" => [
                            "test" => ["test"],
                        ],
                    ],
                ],
            ],
        ];

        $filter = (new BodyQueryFilter())->query($query)->index([$index]);

        $this->assertAttributeEquals(["sm-products"], "indexes", $filter);
        $this->assertAttributeEquals($query, "query", $filter);
    }
}
