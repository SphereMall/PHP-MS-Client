<?php
/**
 * Created by Yurii Koida.
 * 11.04.2018 12:21
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\EntityFactor;
use SphereMall\MS\Entities\Factor;
use SphereMall\MS\Entities\FactorValue;

/**
 * Class FactorsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class EntityFactorsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return EntityFactor
     */
    protected function doCreateObject(array $array)
    {
        $entityFactor = new EntityFactor($array);

        $factor = [
            'id' => $array['factorId'] ?? null,
            'code' => $array['factorCode'] ?? null,
            'name' => $array['factorName'] ?? null,
        ];
        $mapper = new FactorsMapper();
        $entityFactor->factor = $mapper->createObject($factor);

        $factorValue = [
            'id' => $array['id'] ?? null,
            'name' => $array['name'] ?? null,
            'factorId' => $array['factorId'] ?? null,
            'image' => $array['image'] ?? null,
            'description' => $array['description'] ?? null,
        ];
        $mapper = new FactorValuesMapper();
        $entityFactor->factorValue = $mapper->createObject($factorValue);

        return $entityFactor;
    }
    #endregion
}