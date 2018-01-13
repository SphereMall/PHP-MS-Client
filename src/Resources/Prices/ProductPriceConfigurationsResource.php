<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 1/13/2018
 * Time: 12:33 PM
 */

namespace SphereMall\MS\Resources\Prices;

use SphereMall\MS\Entities\Price\ProductPriceConfiguration;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Lib\Prices\PriceConfigurationFilter;
use SphereMall\MS\Lib\Prices\PriceProduct;
use SphereMall\MS\Resources\Resource;

/**
 * Class ProductPriceConfigurationsResource
 * @package SphereMall\MS\Resources\Prices
 */
class ProductPriceConfigurationsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "findprice";
    }

    /**
     * @param $data
     * @throws MethodNotFoundException
     */
    public function create($data)
    {
        throw new MethodNotFoundException("Method create() can not be use with product price configurations");
    }

    /**
     * @param int $id
     * @throws MethodNotFoundException
     */
    public function get(int $id)
    {
        throw new MethodNotFoundException("Method get() can not be use with product price configurations");
    }

    /**
     * @param $id
     * @param $data
     * @throws MethodNotFoundException
     */
    public function update($id, $data)
    {
        throw new MethodNotFoundException("Method update() can not be use with product price configurations");
    }

    /**
     * @param $id
     * @return bool|void
     * @throws MethodNotFoundException
     */
    public function delete($id)
    {
        throw new MethodNotFoundException("Method delete() can not be use with product price configurations");
    }
    #endregion

    #region [Public methods]
    /**
     * @param PriceConfigurationFilter $priceConfigurationFilter
     * @return array|ProductPriceConfiguration[]
     * @throws \SphereMall\MS\Exceptions\SMSDKException
     */
    public function findPrice(PriceConfigurationFilter $priceConfigurationFilter)
    {
        $data = $priceConfigurationFilter->getData();

        $response = $this->handler->handle('POST', $data);
        if (!$response->getSuccess()) {
            throw new EntityNotFoundException($response->getErrorMessage());
        }

        return $this->make($response);
    }

    /**
     * @param PriceProduct $product
     * @return ProductPriceConfiguration|null
     * @throws \SphereMall\MS\Exceptions\SMSDKException
     */
    public function findProductPrice(PriceProduct $product)
    {
        $priceConfigurationFilter = new PriceConfigurationFilter();
        $priceConfigurationFilter->addProduct($product);

        $result = $this->findPrice($priceConfigurationFilter);
        if (isset($result[0])) {
            return $result[0];
        }

        return null;
    }
    #endregion
}