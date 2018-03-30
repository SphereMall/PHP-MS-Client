<?php
/**
 * Created by SergeyBondarchuk.
 * 30.03.2018 12:32
 */

namespace SphereMall\MS\Tests\Resources\Grapher;


use SphereMall\MS\Resources\Grapher\FactorsResource;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class FactorsResourceTest extends SetUpResourceTest
{

    #region [Test methods]
    /**
     * @test
     */
    public function is_factor_resource()
    {
        $factors = $this->client->factors();
        $this->assertInstanceOf(FactorsResource::class, $factors);
    }

    /**
     * @test
     */
    public function available_factors_resource()
    {
        $factors = $this->client->factors()->full('test');
        $this->assertNotEmpty($factors);
    }
    #endregion

}