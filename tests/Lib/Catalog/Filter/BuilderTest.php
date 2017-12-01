<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/30/2017
 * Time: 1:40 PM
 */


namespace SphereMall\MS\Tests\Lib\Catalog\Filter;

use SphereMall\MS\Lib\Catalog\Filter\Builder as CatalogFilterBuilder;
use SphereMall\MS\Lib\Filters\FilterOperators;
use SphereMall\MS\Lib\Filters\GridFilter;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class BuilderTest extends SetUpResourceTest
{
    #region [Properties]
    #endregion

    public function testCatalogFilterBuilder()
    {
        $catalogItem = $this->client
            ->catalogItems()
            ->filter(['filterSettings' => [FilterOperators::NOT_EQUAL => 'null']])
            ->first();

        $builder = new CatalogFilterBuilder($catalogItem->filterSettings);
        $filter = $builder->getFilter();

        $this->assertInstanceOf(GridFilter::class, $filter);
    }
}