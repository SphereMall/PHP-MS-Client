<?php
/**
 * Created by PhpStorm.
 * User: davidych
 * Date: 28.11.18
 * Time: 15:37
 */

namespace SphereMall\MS\Tests\Resources\ElasticSearch;


use SphereMall\MS\Entities\Document;
use SphereMall\MS\Entities\Page;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Lib\Filters\Elastic\Builders\EntitiesFilterBuilder;
use SphereMall\MS\Lib\Filters\Elastic\Builders\GroupByFilterBuilder;
use SphereMall\MS\Lib\Filters\Elastic\Builders\KeywordFilterBuilder;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\AttributesFilter;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\BrandsFilter;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements\AttributesElement;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements\AttributeValueIdElement;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements\AttributeValuesElement;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements\PriceRangeElement;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\FunctionalNamesFilter;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\ParamsFilter;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\PriceRangeFilter;
use SphereMall\MS\Lib\Filters\Elastic\Config\AttributesConfig;
use SphereMall\MS\Lib\Filters\Elastic\Config\BrandsConfig;
use SphereMall\MS\Lib\Filters\Elastic\Config\ConfigBuilder;
use SphereMall\MS\Lib\Filters\Elastic\Config\FactorValuesConfig;
use SphereMall\MS\Lib\Filters\Elastic\Config\FunctionalNamesConfig;
use SphereMall\MS\Lib\Filters\Elastic\Config\PriceRangeConfig;
use SphereMall\MS\Lib\Filters\Interfaces\ElasticConfigElementInterface;
use SphereMall\MS\Lib\Filters\Interfaces\ElasticConfigInterface;
use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;
use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterElementInterface;
use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterInterface;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class ElasticResourceTest extends SetUpResourceTest
{
    public function testPriceRangeConfig()
    {
        $priceConfigTrue  = new PriceRangeConfig(true);
        $priceConfigFalse = new PriceRangeConfig(false);

        $this->assertInstanceOf(ElasticConfigElementInterface::class, $priceConfigFalse);
        $this->assertEquals(['priceRange' => true], $priceConfigTrue->getElements());
        $this->assertEquals(['priceRange' => false], $priceConfigFalse->getElements());
    }

    public function testFunctionalNamesConfig()
    {
        $functionalNamesConfigTrue  = new FunctionalNamesConfig(true);
        $functionalNamesConfigFalse = new FunctionalNamesConfig(false);

        $this->assertInstanceOf(ElasticConfigElementInterface::class, $functionalNamesConfigFalse);
        $this->assertEquals(['functionalNames' => true], $functionalNamesConfigTrue->getElements());
        $this->assertEquals(['functionalNames' => false], $functionalNamesConfigFalse->getElements());
    }

    public function testBrandConfig()
    {
        $brandConfigTrue  = new BrandsConfig(true);
        $brandConfigFalse = new BrandsConfig(false);

        $this->assertInstanceOf(ElasticConfigElementInterface::class, $brandConfigFalse);
        $this->assertEquals(['brands' => true], $brandConfigTrue->getElements());
        $this->assertEquals(['brands' => false], $brandConfigFalse->getElements());
    }

    public function testFactorValuesConfig()
    {
        $factorValues       = [1, 2, 3];
        $factorValuesConfig = new FactorValuesConfig($factorValues);

        $this->assertInstanceOf(ElasticConfigElementInterface::class, $factorValuesConfig);
        $this->assertEquals(['factorValues' => $factorValues], $factorValuesConfig->getElements());
    }

    public function testAttributesConfig()
    {
        $attributes = ['color', 'bus', 'test'];

        $attributesConfig = new AttributesConfig($attributes);

        $this->assertInstanceOf(ElasticConfigElementInterface::class, $attributesConfig);
        $this->assertEquals(['attributes' => $attributes], $attributesConfig->getElements());
    }

    public function testConfigBuilder()
    {
        $attributes   = ['color', 'bus', 'test'];
        $factorValues = [1, 2, 3];

        $priceConfig           = new PriceRangeConfig(true);
        $functionalNamesConfig = new FunctionalNamesConfig(true);
        $brandConfig           = new BrandsConfig(true);
        $attributesConfig      = new AttributesConfig($attributes);
        $factorValuesConfig    = new FactorValuesConfig($factorValues);

        $config = new ConfigBuilder([$priceConfig, $attributesConfig, $brandConfig, $functionalNamesConfig, $factorValuesConfig]);

        $this->assertInstanceOf(ElasticConfigInterface::class, $config);
        $this->assertEquals([
            'priceRange'      => true,
            'attributes'      => $attributes,
            'brands'          => true,
            'functionalNames' => true,
            'factorValues'    => $factorValues,
        ], $config->getConfig());
    }

    public function testEntitiesFilterBuilder()
    {
        $entities = new EntitiesFilterBuilder(Product::class, Document::class, Page::class);

        $this->assertInstanceOf(ElasticFilterInterface::class, $entities);
        $this->assertEquals(['entities' => 'sm-products,sm-documents,sm-pages'], $entities->getParams());
    }

    public function testGroupByFilterBuilder()
    {
        $field   = "variant";
        $groupBy = new GroupByFilterBuilder($field);

        $this->assertInstanceOf(ElasticFilterInterface::class, $groupBy);
        $this->assertEquals(['groupBy' => $field], $groupBy->getParams());
    }

    public function testKeywordFilterBuilder()
    {
        $keyword = "test";
        $fields  = ["title"];

        $keywordFilter = new KeywordFilterBuilder($keyword, $fields);

        $this->assertInstanceOf(ElasticFilterInterface::class, $keywordFilter);
        $this->assertEquals([
            "keyword" => json_encode([
                "value"  => $keyword,
                "fields" => $fields,
            ]),
        ], $keywordFilter->getParams());
    }

    public function testPriceRangeFilter()
    {
        $min = 1;
        $max = 100;

        $price = new PriceRangeElement($min, $max);

        $this->assertEquals([
            'min' => $min,
            'max' => $max,
        ], $price->getPrices());

        $priceFilter = new PriceRangeFilter($price);

        $this->assertInstanceOf(ParamFilterElementInterface::class, $priceFilter);
        $this->assertEquals([
            'priceRange' => [
                [
                    'min' => $min,
                    'max' => $max,
                ],
            ],
        ], $priceFilter->getParams());
    }

    public function testAttributesElement()
    {
        $attrId       = "color";
        $attrValues   = new AttributeValuesElement(['red', 'green']);
        $attrValuesId = new AttributeValueIdElement([1, 2]);

        $attrEl   = new AttributesElement($attrId, $attrValues);
        $attrElId = new AttributesElement($attrId, $attrValuesId);

        $this->assertEquals([
            $attrId => [
                "value" => ["red", "green"],
            ],
        ], $attrEl->getAttributes());

        $this->assertEquals([
            $attrId => [
                "id" => [1,2]
            ]
        ], $attrElId->getAttributes());

        $attrParams = new AttributesFilter($attrEl);

        $this->assertInstanceOf(ParamFilterElementInterface::class, $attrParams);

        $this->assertEquals([
            'attributes' => [
                $attrId => ["value" => ["red", "green"]],
            ],
        ], $attrParams->getParams());
    }

    public function testBrandsFilter()
    {
        $brands = [1, 2];

        $brandsElement = new BrandsFilter($brands);

        $this->assertInstanceOf(ParamFilterElementInterface::class, $brandsElement);
        $this->assertEquals([
            'brands' => $brands,
        ], $brandsElement->getParams());
    }

    public function testFunctionalNamesFilter()
    {
        $functionalNames = [1, 2];

        $functionalNamesElement = new FunctionalNamesFilter($functionalNames);

        $this->assertInstanceOf(ParamFilterElementInterface::class, $functionalNamesElement);
        $this->assertEquals([
            'functionalNames' => $functionalNames,
        ], $functionalNamesElement->getParams());
    }

    public function testParamsFilter()
    {
        $priceRangeFilter      = new PriceRangeFilter(new PriceRangeElement(1, 100));
        $attributesFilter      = new AttributesFilter(new AttributesElement("color", new AttributeValuesElement(['red', 'green'])), new AttributesElement("size", new AttributeValueIdElement([1,2])));
        $brandsFilter          = new BrandsFilter([156, 706]);
        $functionalNamesFilter = new FunctionalNamesFilter([188]);

        $filter = new ParamsFilter([$priceRangeFilter, $attributesFilter, $brandsFilter, $functionalNamesFilter]);

        $this->assertInstanceOf(ParamFilterInterface::class, $filter);
        $this->assertEquals([
            'priceRange' => [
                [
                    'min' => 1,
                    'max' => 100
                ]
            ],
            'attributes' => [
                'color' => [
                    'value' => [
                        'red', 'green'
                    ]
                ],
                'size' => [
                    'id' => [
                        1,2
                    ]
                ]
            ],
            'brands' => [
                156,706
            ],
            'functionalNames' => [
                188
            ]
        ],$filter->getFilters());
    }

}
