<?php

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
