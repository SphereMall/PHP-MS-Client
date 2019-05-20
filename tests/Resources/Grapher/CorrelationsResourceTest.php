<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Grapher;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use SphereMall\MS\Entities\Document;
use SphereMall\MS\Entities\EntitiesCorrelation;
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
     * @throws Exception
     */
    public function not_available_correlations_get()
    {
        $correlations = $this->client->correlations();
        $this->expectException(MethodNotFoundException::class);
        $correlations->get(1);
    }

    /**
     * @test
     * @throws Exception
     */
    public function not_available_correlations_create()
    {
        $correlations = $this->client->correlations();
        $this->expectException(MethodNotFoundException::class);
        $correlations->create([]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function not_available_correlations_update()
    {
        $correlations = $this->client->correlations();
        $this->expectException(MethodNotFoundException::class);
        $correlations->update(1, []);
    }

    /**
     * @test
     * @throws Exception
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
        if (is_object($correlations)) {
            $this->assertNotEquals(0, $correlations->count());
        } else {
            $this->assertEquals([], $correlations);
        }
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
        $filter     = new GridFilter();
        $filter->elements([
            new EntityFilter([Product::class]),
            new FunctionalNameFilter([$funcNameId]),
        ]);

        $correlations = $this->client->correlations()
                                     ->filter($filter)
                                     ->withMeta()
                                     ->getById(4, Document::class);
        if (is_object($correlations)) {
            $this->assertNotEquals(0, $correlations->count());
        } else {
            $this->assertEquals([], $correlations);
        }
        /**
         * @var $correlation Product
         */
        foreach ($correlations as $correlation) {
            $this->assertInstanceOf(Product::class, $correlation);
            $this->assertEquals($funcNameId, $correlation->functionalName->id);
        }
    }

    /**
     * @throws GuzzleException
     */
    public function testCorrelationsFromEntityByIds()
    {
        $entityIds    = [1, 2, 3];
        $filterParams = [
            'entity'          => ['products'],
            'functionalNames' => [4],
        ];

        $correlations = $this->client->correlations()
                                     ->getFromEntityByIds('documents', $entityIds, $filterParams);

        $this->assertNotEmpty($correlations);
    }

    /**
     * @throws GuzzleException
     */
    public function testBidirectional()
    {
        $result = $this->client->correlations()->getBidirectional('products', 'entitygroups', [7]);
        foreach ($result as $item) {
            $this->assertInstanceOf(EntitiesCorrelation::class, $item);
        }
    }
    #endregion
}
