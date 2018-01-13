<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Price;

use PHPUnit\Exception;
use SphereMall\MS\Entities\Price\ProductPriceConfiguration;
use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Exceptions\SMSDKException;
use SphereMall\MS\Lib\Http\Request;
use SphereMall\MS\Lib\Http\Response;
use SphereMall\MS\Lib\Mappers\ProductPriceConfigurationsMapper;
use SphereMall\MS\Lib\Prices\PriceConfigurationFilter;
use SphereMall\MS\Lib\Prices\PriceProduct;
use SphereMall\MS\Resources\Prices\ProductPriceConfigurationsResource;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class ProductPriceConfigurationsResourceTest extends SetUpResourceTest
{
    #region [Properties]
    protected $priceConfigurationResult = [];
    #endregion

    #region [SetUp]
    protected function setUp()
    {
        parent::setUp();

        $this->priceConfigurationResult['success'] = true;
        $this->priceConfigurationResult['included'] = [];

        $this->priceConfigurationResult['data'] = [
            [
                "type"       => "productPriceConfigurations",
                "id"         => "282",
                "attributes" => [
                    "id"        => "282",
                    "productId" => 607,
                    "prices"    => [
                        "affectAttributes" => ["226", "227"],
                        "priceTable"       => [
                            "3748;3749" => "4769",
                            "3748;3750" => "5269",
                            "3748;3751" => "5769",
                            "3748;3752" => "6269",
                            "3748;3753" => "6769",
                            "3748;3754" => "7269",
                            "3748;3755" => "7769",
                            "3748;3756" => "8269",
                            "3748;3757" => "8864",
                            "3748;3758" => "9509",
                            "3748;3759" => "10154",
                            "3748;3760" => "10947",
                            "3748;3761" => "11840",
                            "3748;3762" => "12633",
                            "3748;3763" => "13625",
                            "3748;3764" => "14716",
                            "3748;3765" => "15460",
                            "3748;3766" => "15707",
                            "3748;3767" => "16005",
                            "3748;3768" => "16402",
                            "3748;3769" => "16749",
                            "3748;3770" => "16947",
                        ],
                    ],
                ],
            ],
        ];
    }
    #endregion

    #region [Test methods]
    /** @test */
    public function is_product_price_configuration_resource_available()
    {
        $priceConfiguration = $this->client->productPriceConfigurations();
        $this->assertInstanceOf(ProductPriceConfigurationsResource::class, $priceConfiguration);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function not_available_product_price_configurations_get()
    {
        $priceConfiguration = $this->client->productPriceConfigurations();
        $this->expectException(MethodNotFoundException::class);
        $priceConfiguration->get(1);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function not_available_product_price_configurations_delete()
    {
        $priceConfiguration = $this->client->productPriceConfigurations();
        $this->expectException(MethodNotFoundException::class);
        $priceConfiguration->delete(1);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function not_available_product_price_configurations_update()
    {
        $priceConfiguration = $this->client->productPriceConfigurations();
        $this->expectException(MethodNotFoundException::class);
        $priceConfiguration->update(1, []);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function not_available_product_price_configurations_create()
    {
        $priceConfiguration = $this->client->productPriceConfigurations();
        $this->expectException(MethodNotFoundException::class);
        $priceConfiguration->create([]);
    }

    /** @test
     * @throws \Exception
     */
    public function is_at_least_one_product_available_for_filter()
    {
        $priceConfiguration = $this->client->productPriceConfigurations();
        $this->expectException(SMSDKException::class);

        $priceConfigurationFilter = new PriceConfigurationFilter();
        $priceConfiguration->findPrice($priceConfigurationFilter);
    }

    /** @test
     * @throws SMSDKException
     */
    public function available_method_find_price()
    {
        $priceConfigurationFilter = new PriceConfigurationFilter();
        $priceConfigurationFilter->addProduct(new PriceProduct(607, 1));

        $productPriceConfigurationsResource = $this->getProductPriceConfMockedResource($priceConfigurationFilter);
        //$productPriceConfigurationsResource = $this->client->productPriceConfigurations();

        $productPriceConfigurations = $productPriceConfigurationsResource->findPrice($priceConfigurationFilter);
        $this->assertCount(1, $productPriceConfigurations);

        $productPriceConfiguration = (new ProductPriceConfigurationsMapper())->createObject($this->priceConfigurationResult['data'][0]['attributes']);

        $this->assertEquals($productPriceConfiguration, $productPriceConfigurations[0]);
    }

    /** @test
     * @throws SMSDKException
     */
    public function available_method_find_product_price()
    {
        $priceConfigurationFilter = new PriceConfigurationFilter();
        $priceConfigurationFilter->addProduct(new PriceProduct(607, 1));

        $productPriceConfigurationsResource = $this->getProductPriceConfMockedResource($priceConfigurationFilter);
        //$productPriceConfigurationsResource = $this->client->productPriceConfigurations();

        $productPrice = $productPriceConfigurationsResource->findProductPrice(new PriceProduct(607, 1));

        $productPriceConfiguration = (new ProductPriceConfigurationsMapper())->createObject($this->priceConfigurationResult['data'][0]['attributes']);

        $this->assertEquals($productPriceConfiguration, $productPrice);
    }
    #endregion

    #region [Private methods]
    /**
     * @param $priceConfigurationFilter
     * @return ProductPriceConfigurationsResource
     */
    private function getProductPriceConfMockedResource($priceConfigurationFilter): ProductPriceConfigurationsResource
    {
        $requestHandler = $this->createMock(Request::class);
        $response = new \GuzzleHttp\Psr7\Response(200, [], json_encode($this->priceConfigurationResult));

        $requestHandler->method('handle')
            ->with('POST', $priceConfigurationFilter->getData())
            ->will($this->returnValue(new Response($response)));


        $productPriceConfigurationsResource = new ProductPriceConfigurationsResource(
            $this->client,
            'v1',
            $requestHandler
        );
        return $productPriceConfigurationsResource;
    }
    #endregion
}
