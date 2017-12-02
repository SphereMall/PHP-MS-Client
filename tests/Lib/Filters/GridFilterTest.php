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
use SphereMall\MS\Lib\Filters\Grid\FunctionalNameFilter;
use SphereMall\MS\Lib\Filters\Grid\GridFilter;
use SphereMall\MS\Lib\Filters\Grid\GridFilterElement;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class GridFilterTest extends SetUpResourceTest
{
    public function testGridFilterSingleElement()
    {
        $gfe = FunctionalNameFilter::create()
            ->value(6);

        $this->assertEquals('functionalNames', $gfe->getName());
        $this->assertEquals([[6]], $gfe->getValues());
    }

    public function testGridFilterElements()
    {
        $gfe = AttributeFilter::create()
            ->value(128)
            ->andValue(1)
            ->andValue(2);

        $this->assertEquals('attributes', $gfe->getName());
        $this->assertEquals([[128, 1, 2]], $gfe->getValues());

        $gfe = AttributeFilter::create()
            ->value([1, 3, 5]);

        $this->assertEquals('attributes', $gfe->getName());
        $this->assertEquals([[1, 3, 5]], $gfe->getValues());
        $this->assertNotEquals([[3, 1, 5]], $gfe->getValues());

        $gfe = AttributeFilter::create()
            ->value(2)
            ->andValue(4)
            ->orValue(6);

        $this->assertEquals('attributes', $gfe->getName());
        $this->assertEquals([[2, 4], [6]], $gfe->getValues());

        $gfe = BrandFilter::create()
            ->value([1, 2, 3])
            ->orValue([4, 5, 6])
            ->andValue(7)
            ->orValue([8, 9]);

        $this->assertEquals('brands', $gfe->getName());
        $this->assertEquals([[1, 2, 3], [4, 5, 6, 7], [8, 9]], $gfe->getValues());
    }

    public function testGridFilter()
    {
        $attr = AttributeFilter::create()
            ->value([1, 2, 3])
            ->orValue([3, 2, 4]);

        $this->assertEquals('attributes', $attr->getName());
        $this->assertEquals([[1, 2, 3], [3, 2, 4]], $attr->getValues());

        $fn = FunctionalNameFilter::create()
            ->value([1, 2]);

        $this->assertEquals('functionalNames', $fn->getName());
        $this->assertEquals([[1, 2]], $fn->getValues());

        $filter = new GridFilter();

        $f = (string)$filter->element($attr)
            ->orElement($fn);

        $this->assertEquals('filter=[{"attributes":[[1,2,3],[3,2,4]]},{"functionalNames":[[1,2]]}]',
            urldecode($f));

        $filter = new GridFilter();
        $f1 = (string)$filter->element($attr)
            ->andElement($fn);

        $this->assertEquals('filter=[{"attributes":[[1,2,3],[3,2,4]],"functionalNames":[[1,2]]}]',
            urldecode($f1));


        $attr = AttributeFilter::create()
            ->value([1022]);
        $filter = new GridFilter();
        $f1 = (string)$filter->element($attr);

        $this->assertEquals('filter=[{"attributes":[[1022]]}]', urldecode($f1));

        $ent = EntityFilter::create()
            ->value(['product']);
        $filter = new GridFilter();
        $f1 = (string)$filter->element($ent);

        $this->assertEquals('filter=[{"entity":[["product"]]}]', urldecode($f1));

        $fn = FunctionalNameFilter::create()
            ->value([5]);

        $filter = new GridFilter();
        $f1 = (string)$filter->element($attr)
            ->element($ent)
            ->orElement($fn);

        $this->assertEquals('filter=[{"attributes":[[1022]],"entity":[["product"]]},{"functionalNames":[[5]]}]',
            urldecode($f1));
    }

    public function testGridFilterParams()
    {
        $attr = AttributeFilter::create()
            ->value([1, 2, 3])
            ->orValue([3, 2, 4]);

        $this->assertEquals('attributes', $attr->getName());
        $this->assertEquals([[1, 2, 3], [3, 2, 4]], $attr->getValues());

        $fn = FunctionalNameFilter::create()
            ->value([1, 2]);

        $this->assertEquals('functionalNames', $fn->getName());
        $this->assertEquals([[1, 2]], $fn->getValues());

        $attr1 = AttributeFilter::create()
            ->value([1, 5]);

        $filter = new GridFilter();
        $f = (string)$filter->element($attr)
            ->orElement($fn)
            ->andElement($attr1);

        $this->assertEquals('filter=[{"attributes":[[1,2,3],[3,2,4]]},{"functionalNames":[[1,2]],"attributes":[[1,5]]}]',
            urldecode($f));
    }
}