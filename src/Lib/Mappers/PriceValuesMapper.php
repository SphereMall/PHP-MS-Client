<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 1/13/2018
 * Time: 2:17 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Price\ProductPriceConfiguration;

/**
 * Class PriceValuesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class PriceValuesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return ProductPriceConfiguration
     */
    protected function doCreateObject(array $array)
    {
        $productPriceConfiguration = new ProductPriceConfiguration($array);

        if (isset($array['prices']['affectAttributes'])) {
            $productPriceConfiguration->affectedAttributes = $array['prices']['affectAttributes'];
        }

        if (isset($array['prices']['priceTable'])) {
            foreach ($array['prices']['priceTable'] as $priceKey => $price) {
                $productPriceConfiguration->priceTable[$priceKey] = $price;
            }
        }
        // deprecated - work with an old response structure
        if(isset($array['prices']['priceWithVat'])) {
            $productPriceConfiguration->priceWithVat = $array['prices']['priceWithVat'];
        }
        if(isset($array['prices']['priceWithoutVat'])) {
            $productPriceConfiguration->priceWithoutVat = $array['prices']['priceWithoutVat'];
        }

        //Work with a new response structure
        if (isset($array['priceWithVat'])) {
            $productPriceConfiguration->priceWithVat = $array['priceWithVat'];
        }
        if (isset($array['priceWithoutVat'])) {
            $productPriceConfiguration->priceWithoutVat = $array['priceWithoutVat'];
        }
        if (isset($array['vatId'])) {
            $productPriceConfiguration->vatId = $array['vatId'];
        }
        if (isset($array['productVatId'])) {
            $productPriceConfiguration->productVatId = $array['productVatId'];
        }
        if (isset($array['vatPercent'])) {
            $productPriceConfiguration->vatPercent = $array['vatPercent'];
        }

        $productPriceConfiguration->removeProperty('prices');

        return $productPriceConfiguration;
    }
    #endregion
}
