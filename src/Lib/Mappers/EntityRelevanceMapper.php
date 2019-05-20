<?php
/**
 * Created by Yurii Koida.
 * 11.04.2018 12:21
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\EntityRelevance;

/**
 * Class EntityRelevanceMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class EntityRelevanceMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return EntityRelevance
     */
    protected function doCreateObject(array $array)
    {
        return new EntityRelevance($array);
    }
    #endregion
}
