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
use SphereMall\MS\Entities\Page;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Lib\FilterParams\ElasticSearch\AttributeFilterParams;
use SphereMall\MS\Lib\FilterParams\ElasticSearch\IndexFilterParams;
use SphereMall\MS\Lib\FilterParams\ElasticSearch\MatchFilterParams;
use SphereMall\MS\Lib\FilterParams\ElasticSearch\PriceRangeFilterParams;
use SphereMall\MS\Lib\FilterParams\ElasticSearch\TermsFilterParams;
use SphereMall\MS\Lib\Filters\ElasticSearch\FullTextFilter;
use SphereMall\MS\Lib\Filters\ElasticSearch\MatchFilter;
use SphereMall\MS\Lib\Filters\ElasticSearch\MatchPhraseFilter;
use SphereMall\MS\Lib\Filters\ElasticSearch\PriceRangeFilter;
use SphereMall\MS\Lib\Filters\ElasticSearch\SearchFilter;
use SphereMall\MS\Lib\Filters\ElasticSearch\ElasticSearchIndexFilter;
use SphereMall\MS\Lib\Filters\ElasticSearch\TermsFilter;
use SphereMall\MS\Lib\SortParams\ElasticSearch\FieldSortParams;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class ElasticSearchResourceTest extends SetUpResourceTest
{
    protected $langCode = 'fr';

    #region [Test methods]
    public function testFullTextSearch()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class, Document::class, Page::class]));

        $filter = new FullTextFilter();
        $filter->index([$index])
               ->keyword('test');

        $all = $this->client->elasticSearch()
                            ->filter($filter)
                            ->sort(new FieldSortParams('lastUpdate'))
                            ->limit(100)
                            ->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testMatchSearch()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class, Document::class, Page::class]));

        $match = new MatchFilter(new MatchFilterParams('title', 'Product'), [$this->langCode]);

        $searchFilter = (new SearchFilter())->index([$index])
                                            ->elements([$match]);

        $all = $this->client->elasticSearch()
                            ->filter($searchFilter)
                            ->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testMatchPhraseSearch()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class, Document::class, Page::class]));

        $match = new MatchPhraseFilter(new MatchFilterParams('title', 'test'), [$this->langCode]);

        $searchFilter = (new SearchFilter())->index([$index])
                                            ->elements([$match]);

        $all = $this->client->elasticSearch()
                            ->filter($searchFilter)
                            ->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testPriceRangeSearch()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class, Document::class, Page::class]));

        $price = new PriceRangeFilter(new PriceRangeFilterParams(100, 6060));

        $searchFilter = (new SearchFilter())->index([$index])
                                            ->elements([$price]);

        $all = $this->client->elasticSearch()
                            ->filter($searchFilter)
                            ->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testBrandFilterSearch()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class, Document::class, Page::class]));

        $brandTerm = new TermsFilter(new TermsFilterParams('brandId', [333, 50]));

        $searchFilter = (new SearchFilter())->index([$index])
                                            ->elements([$brandTerm]);

        $all = $this->client->elasticSearch()
                            ->filter($searchFilter)
                            ->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testFunctionalNameFilterSearch()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class, Document::class, Page::class]));

        $functionalNameTerm = new TermsFilter(new TermsFilterParams('functionalNameId', [50]));

        $searchFilter = (new SearchFilter())->index([$index])
                                            ->elements([$functionalNameTerm]);

        $all = $this->client->elasticSearch()
                            ->filter($searchFilter)
                            ->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testAttributeFilterSearch()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class, Document::class, Page::class]));

        $attr = new TermsFilter(new AttributeFilterParams(7, [279, 554]));

        $searchFilter = (new SearchFilter())->index([$index])
                                            ->elements([$attr]);

        $all = $this->client->elasticSearch()
                            ->filter($searchFilter)
                            ->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    public function testMultipleFiltersSearch()
    {
        $index = new ElasticSearchIndexFilter(new IndexFilterParams([Product::class, Document::class, Page::class]));

        $brandTerm = new TermsFilter(new TermsFilterParams('brandId', [333, 50]));
        $attrTerm  = new TermsFilter(new AttributeFilterParams(7, [279, 554]));
        $priceTerm = new TermsFilter(new TermsFilterParams('price', [6600]));

        $searchFilter = (new SearchFilter())->index([$index])
                                            ->elements([$brandTerm, $attrTerm, $priceTerm]);

        $all = $this->client->elasticSearch()
                            ->filter($searchFilter)
                            ->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }
    #endregion
}
