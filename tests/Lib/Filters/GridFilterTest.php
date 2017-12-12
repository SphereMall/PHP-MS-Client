<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/30/2017
 * Time: 1:40 PM
 */


namespace SphereMall\MS\Tests\Lib\Filters;

use SphereMall\MS\Lib\Filters\Grid\AttributeFilter;
use SphereMall\MS\Lib\Filters\Grid\BrandFilter;
use SphereMall\MS\Lib\Filters\Grid\EntityFilter;
use SphereMall\MS\Lib\Filters\Grid\FactorFilter;
use SphereMall\MS\Lib\Filters\Grid\FunctionalNameFilter;
use SphereMall\MS\Lib\Filters\Grid\GridFilter;
use SphereMall\MS\Lib\Filters\Grid\GridFilterElement;
use SphereMall\MS\Lib\Filters\Grid\PriceRangeFilter;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class GridFilterTest extends SetUpResourceTest
{
    public function testGridFilterSingleElement()
    {
        $gfe = new FunctionalNameFilter([6]);

        $this->assertEquals('functionalNames', $gfe->getName());
        $this->assertEquals([6], $gfe->getValues());
    }

    public function testGridFilterElements()
    {
        $gfe = new AttributeFilter([128, 1, 2]);

        $this->assertEquals('attributes', $gfe->getName());
        $this->assertEquals([128, 1, 2], $gfe->getValues());

        $gfe = new AttributeFilter([1, 3, 5]);

        $this->assertEquals('attributes', $gfe->getName());
        $this->assertEquals([1, 3, 5], $gfe->getValues());
        $this->assertNotEquals([3, 1, 5], $gfe->getValues());
    }

    public function testGridFilter()
    {
        $attr = new AttributeFilter([1, 2, 3]);

        $this->assertEquals('attributes', $attr->getName());
        $this->assertEquals([1, 2, 3], $attr->getValues());

        $fn = new FunctionalNameFilter([1, 2]);

        $this->assertEquals('functionalNames', $fn->getName());
        $this->assertEquals([1, 2], $fn->getValues());

        $filter = new GridFilter();

        $f = (string)$filter->elements([$attr])
            ->elements([$fn]);

        $this->assertEquals('params=[{"attributes":[1,2,3]},{"functionalNames":[1,2]}]',
            urldecode($f));

        $filter = new GridFilter();
        $f1 = (string)$filter->elements([$attr, $fn]);

        $this->assertEquals('params=[{"attributes":[1,2,3],"functionalNames":[1,2]}]',
            urldecode($f1));


        $attr = new AttributeFilter([1022]);
        $filter = new GridFilter();
        $f1 = (string)$filter->elements([$attr]);

        $this->assertEquals('params=[{"attributes":[1022]}]', urldecode($f1));

        $ent = new EntityFilter(['product']);
        $filter = new GridFilter();
        $f1 = (string)$filter->elements([$ent]);

        $this->assertEquals('params=[{"entity":["product"]}]', urldecode($f1));

        $fn = new FunctionalNameFilter([5]);

        $filter = new GridFilter();
        $f1 = (string)$filter->elements([$attr, $ent])
            ->elements([$fn]);

        $this->assertEquals('params=[{"attributes":[1022],"entity":["product"]},{"functionalNames":[5]}]',
            urldecode($f1));
    }

    public function testGridFilterParams()
    {
        $attr1 = new AttributeFilter([1, 2, 3]);
        $attr2 = new AttributeFilter([3, 2, 4]);

        $this->assertEquals('attributes', $attr1->getName());
        $this->assertEquals([1, 2, 3], $attr1->getValues());

        $this->assertEquals('attributes', $attr2->getName());
        $this->assertEquals([3, 2, 4], $attr2->getValues());

        $fn = new FunctionalNameFilter([1, 2]);

        $this->assertEquals('functionalNames', $fn->getName());
        $this->assertEquals([1, 2], $fn->getValues());

        $attr1 = new AttributeFilter([1, 5]);

        $filter = new GridFilter();
        $f = (string)$filter->elements([$attr1])
            ->elements([$fn, $attr2]);

        $this->assertEquals('params=[{"attributes":[1,5]},{"functionalNames":[1,2],"attributes":[3,2,4]}]',
            urldecode($f));
    }

    public function testGridFilterWithPrice()
    {
        $attr = new AttributeFilter([1022]);

        $this->assertEquals('attributes', $attr->getName());
        $this->assertEquals([1022], $attr->getValues());

        $fn = new FunctionalNameFilter([5]);

        $this->assertEquals('functionalNames', $fn->getName());
        $this->assertEquals([5], $fn->getValues());

        $br = new BrandFilter([1]);

        $this->assertEquals('brands', $br->getName());
        $this->assertEquals([1], $br->getValues());

        $price = new PriceRangeFilter([10000, 50000]);

        $this->assertEquals('priceRange', $price->getName());
        $this->assertEquals([10000, 50000], $price->getValues());

        $filter = new GridFilter();
        $f = (string)$filter->elements([$attr, $fn, $br, $price]);

        $this->assertEquals('params=[{"attributes":[1022],"functionalNames":[5],"brands":[1],"priceRange":[10000,50000]}]',
            urldecode($f));
    }

    public function testGridFilterWithFactors()
    {
        $attr = new AttributeFilter([1022]);

        $this->assertEquals('attributes', $attr->getName());
        $this->assertEquals([1022], $attr->getValues());

        $fn = new FunctionalNameFilter([5]);

        $this->assertEquals('functionalNames', $fn->getName());
        $this->assertEquals([5], $fn->getValues());

        $factor = new FactorFilter([1]);

        $this->assertEquals('factors', $factor->getName());
        $this->assertEquals([1], $factor->getValues());


        $filter = new GridFilter();
        $f = (string)$filter->elements([$attr])
            ->elements([$fn, $factor]);

        $this->assertEquals('params=[{"attributes":[1022]},{"functionalNames":[5],"factors":[1]}]',
            urldecode($f));
    }

    public function testGridFilterWithAttributeAndFunctionalName()
    {
        $attr = new AttributeFilter([1022]);

        $this->assertEquals('attributes', $attr->getName());
        $this->assertEquals([1022], $attr->getValues());

        $fn = new FunctionalNameFilter([5]);

        $this->assertEquals('functionalNames', $fn->getName());
        $this->assertEquals([5], $fn->getValues());


        $filter = new GridFilter();
        $f = (string)$filter->elements([$fn, $attr]);

        $this->assertEquals('params=[{"functionalNames":[5],"attributes":[1022]}]',
            urldecode($f));
    }
}