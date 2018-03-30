<?php
/**
 * Created by SergeyBondarchuk.
 * 30.03.2018 12:38
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\Factor;
use SphereMall\MS\Entities\FactorValue;

/**
 * Class FactorsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class FactorsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return Factor
     */
    protected function doCreateObject(array $array)
    {
        $factor = new Factor($array);

        if (isset($array['factorValues']) && is_array($array['factorValues'])) {

            foreach ($array['factorValues'] as $factorValueData) {
                $mapper = new FactorValuesMapper();
                $factor->values[] = $mapper->createObject($factorValueData);
            }
        }

        return $factor;
    }
    #endregion
}