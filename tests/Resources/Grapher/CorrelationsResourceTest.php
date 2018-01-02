<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Grapher;

use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Resources\Grapher\CorrelationsResource;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class CorrelationsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    /**
     * @test
     */
    public function is_correlation_resource()
    {
        $correlations = $this->client->correlations();
        $this->assertInstanceOf(CorrelationsResource::class, $correlations);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function not_available_correlations_get()
    {
        $correlations = $this->client->correlations();
        $this->expectException(MethodNotFoundException::class);
        $correlations->get(1);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function not_available_correlations_create()
    {
        $correlations = $this->client->correlations();
        $this->expectException(MethodNotFoundException::class);
        $correlations->create([]);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function not_available_correlations_update()
    {
        $correlations = $this->client->correlations();
        $this->expectException(MethodNotFoundException::class);
        $correlations->update(1, []);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function not_available_correlations_delete()
    {
        $correlations = $this->client->correlations();
        $this->expectException(MethodNotFoundException::class);
        $correlations->delete(1);
    }

    /**
     * @test
     */
    public function is_product_correlations()
    {
        $correlations = $this->client->correlations()->getById(4, Product::class);
        if (empty($correlations)) {
            $this->assertEmpty($correlations);

            return;
        }

        foreach ($correlations as $correlation) {
            $this->assertInstanceOf(Entity::class, $correlation);
        }
    }
    #endregion
}
