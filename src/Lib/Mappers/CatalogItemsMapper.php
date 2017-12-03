<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\CatalogItem;

/**
 * Class CatalogItemsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class CatalogItemsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     * @return CatalogItem
     */
    protected function doCreateObject(array $array)
    {
        $catalogItem = new CatalogItem($array);
        $catalogItem->filterSettings = json_decode((string)$catalogItem->filterSettings, true);

        return $catalogItem;
    }
    #endregion
}