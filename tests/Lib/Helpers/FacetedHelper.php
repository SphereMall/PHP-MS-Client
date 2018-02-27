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

    public function testAddFilter()
    {
        $filters = [];
        $filterArray = ['terms' => ['brandId' => [333,50]]];
        $key = 'test';
        $name = 'terms';
        $expected = ['filter' => ['bool' => ['must' => [0 => ['terms' => ['brandId' => [333, 50]]]]]]];
        $filters = FacetedHelper::addFilter($filters, $filterArray, $key, $name);

        $this->assertEquals($expected, $filters);

        $filters = [];
        $filterArray = ['terms' => ['brandId' => [333,50]]];
        $key = 'brandId';
        $name = 'terms';
        $expected = [];
        $filters = FacetedHelper::addFilter($filters, $filterArray, $key, $name);

        $this->assertEquals($expected, $filters);
    }

    public function testAddAggregation()
    {
        $filters = ['7_attr' => ['field' => '7_attr.valueId']];
        $filterArray = ['terms' => ['brandId' => [333,50]]];
        $key = 'test';
        $name = 'terms';
        $expected = [
            'filter' => ['bool' => ['must' => [0 => ['terms' => ['brandId' => [333, 50]]]]]],
            '7_attr' => ['field' => '7_attr.valueId'],
        ];
        $filters = FacetedHelper::addFilter($filters, $filterArray, $key, $name);


        $this->assertEquals($expected, $filters);
    }
}
