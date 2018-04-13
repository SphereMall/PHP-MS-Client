<?php
/**
 * Created by Yurii Koida.
 * 11.04.2018 11:18
 */

namespace SphereMall\MS\Tests\Resources\Grapher;


use SphereMall\MS\Entities\EntityFactor;
use SphereMall\MS\Resources\Grapher\EntityFactorsResource;
use SphereMall\MS\Resources\Grapher\FactorsResource;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class EntityFactorsResourceTest extends SetUpResourceTest
{

    #region [Test methods]
    /**
     * @test
     */
    public function get_entity_factors()
    {
        $factors = $this->client->entityFactors()->list('users', '177');
        $this->assertEquals(is_array($factors),true);
        foreach ($factors as $factor) {
            $this->assertInstanceOf(EntityFactor::class, $factor);
        }

    }

    /**
     * @test
     */
    public function set_entity_factors()
    {
        $factors = $this->client->entityFactors()->set('users', '177', [6]);
        $this->assertNotEmpty($factors);
        if (is_array($factors)) {
            foreach ($factors as $factor) {
                $this->assertInstanceOf(EntityFactor::class, $factor);
            }
        } else {
            $this->assertInstanceOf(EntityFactor::class, $factors);
        }
    }
    #endregion

}