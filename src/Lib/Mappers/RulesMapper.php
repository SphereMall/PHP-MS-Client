<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 26.04.2018
 * Time: 10:05
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\Rule;

/**
 * Class RulesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class RulesMapper extends Mapper
{
    /**
     * @param array $array
     * @return Rule
     */
    protected function doCreateObject(array $array)
    {
        return new Rule($array);
    }
}