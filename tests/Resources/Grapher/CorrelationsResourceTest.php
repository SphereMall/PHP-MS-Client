<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Grapher;

use SphereMall\MS\Entities\Document;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Lib\Filters\Grid\EntityFilter;
use SphereMall\MS\Lib\Filters\Grid\FunctionalNameFilter;
use SphereMall\MS\Lib\Filters\Grid\GridFilter;
use SphereMall\MS\Lib\Helpers\CorrelationTypeHelper;
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
        $correlations = $this->client->correlations()->withMeta()->getById(4, Product::class);
        $this->assertNotEquals(0, $correlations->count());
        foreach ($correlations as $correlation) {
            $this->assertInstanceOf(Entity::class, $correlation);
        }
    }

    /**
     * @test
     */
    public function is_product_type_title_correct()
    {
        $type = CorrelationTypeHelper::getGraphTypeByClass(Product::class);
        $this->assertEquals('products', $type);
    }

    /**
     * @test
     */
    public function test__correlations_with_filter()
    {
        $funcNameId = 1;
        $filter = new GridFilter();
        $filter->elements([
            new EntityFilter([Product::class]),
            new FunctionalNameFilter([$funcNameId])
        ]);

        $correlations = $this->client->correlations()
                                     ->filter($filter)
                                     ->withMeta()
                                     ->getById(4, Document::class);
        $this->assertNotEquals(0, $correlations->count());
        /**
         * @var $correlation Product
         */
        foreach ($correlations as $correlation) {
            $this->assertInstanceOf(Product::class, $correlation);
            $this->assertEquals($funcNameId, $correlation->functionalName->id);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCorrelationsFromEntityByIds()
    {
        $correlations = $this->client->correlations()->getFromEntityByIds('documents', [1, 2, 3]);

        $this->assertNotEmpty($correlations);
    }
    #endregion
}
