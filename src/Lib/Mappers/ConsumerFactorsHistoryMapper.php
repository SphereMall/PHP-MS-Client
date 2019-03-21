<?php

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\ConsumerFactorHistory;

/**
 * Class ConsumerFactorsMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class ConsumerFactorsHistoryMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return ConsumerFactorHistory
     */
    protected function doCreateObject(array $array)
    {
        $consumerFactor          = new ConsumerFactorHistory($array);
        $consumerFactor->context = json_decode($consumerFactor->context);
        $consumerFactor->factors = json_decode($consumerFactor->factors);

        return $consumerFactor;
    }
    #endregion
}
