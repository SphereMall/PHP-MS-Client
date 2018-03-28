<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/30/2017
 * Time: 1:40 PM
 */


namespace SphereMall\MS\Tests\Lib\Helpers;

use SphereMall\MS\Tests\Resources\SetUpResourceTest;
use SphereMall\MS\Lib\Helpers\FacetedHelper;

/**
 * Class FacetedHelper
 * @package SphereMall\MS\Tests\Lib\Helpers
 */
class FacetedHelperTest extends SetUpResourceTest
{

    protected $filters = [];
    protected $filterArray = ['terms' => ['brandId' => [333,50]]];
    protected $key = 'test';
    protected $name = 'terms';
    protected $expected = ['filter' => ['bool' => ['must' => [0 => ['terms' => ['brandId' => [333, 50]]]]]]];

    public function testAddFilter()
    {
        $filters = FacetedHelper::addFilter($this->filters, $this->filterArray, $this->key, $this->name);

        $this->assertEquals($this->expected, $filters);

        $this->filters = [];
        $this->filterArray = ['terms' => ['brandId' => [333,50]]];
        $this->key = 'brandId';
        $this->name = 'terms';
        $this->expected = [];
        $filters = FacetedHelper::addFilter($this->filters, $this->filterArray, $this->key, $this->name);

        $this->assertEquals($this->expected, $filters);
    }

    public function testAddAggregation()
    {
        $this->filters = ['7_attr' => ['field' => '7_attr.valueId']];
        $this->filterArray = ['terms' => ['brandId' => [333,50]]];
        $this->key = 'test';
        $this->name = 'terms';
        $this->expected = [
            'filter' => ['bool' => ['must' => [0 => ['terms' => ['brandId' => [333, 50]]]]]],
            '7_attr' => ['field' => '7_attr.valueId'],
        ];
        $filters = FacetedHelper::addFilter($this->filters, $this->filterArray, $this->key, $this->name);


        $this->assertEquals($this->expected, $filters);
    }
}
