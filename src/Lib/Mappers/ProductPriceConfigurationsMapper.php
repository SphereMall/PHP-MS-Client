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
 * Class ProductPriceConfigurationsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class ProductPriceConfigurationsMapper extends Mapper
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

        $productPriceConfiguration->removeProperty('prices');

        return $productPriceConfiguration;
    }
    #endregion
}
