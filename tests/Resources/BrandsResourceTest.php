<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources;

use SphereMall\MS\Entities\Brand;

class BrandsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testBrandsServiceGetList()
    {
        //Get all brands - limit 10
        $brands = $this->client->brands();
        $brandList = $brands->all();

        //Check amount
        $this->assertEquals(10, $brandList->count());

        //Get id for first brand
        $ids[] = $brandList->current()->id;
        //Get brand by ids
        $brandList = $brands->ids($ids)->all();
        //Check amount
        $this->assertEquals(1, $brandList->count());

        //Check is brands equal
        $this->assertEquals($ids, $brands->getIds());

        //Check instanceof brand class
        foreach ($brandList as $brand) {
            $this->assertInstanceOf(Brand::class, $brand);
        }
    }

    #endregion
}
