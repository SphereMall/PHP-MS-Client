<?php
/**
 * Created by SergeyBondarchuk.
 * 30.03.2018 12:32
 */

namespace SphereMall\MS\Tests\Resources\Grapher;

use SphereMall\MS\Entities\Factor;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class FactorsResourceTest extends SetUpResourceTest
{

    #region [Test methods]
    /**
     * @test
     */
    public function testFactorsDetailAll()
    {
        $factors = $this->client->factors()->detailAll([38, 50]);
        $this->assertInstanceOf(Factor::class, $factors[0]);
    }

    /**
     * @test
     */
    public function testFactorsDetailById()
    {
        $factors = $this->client->factors()->detailById(50);
        $this->assertInstanceOf(Factor::class, $factors);
    }

    /**
     * @test
     */
    public function testFactorsDetailByCode()
    {
        $factors = $this->client->factors()->detailByCode("test_qa_1");
        $this->assertInstanceOf(Factor::class, $factors[0]);
    }
    #endregion
}
