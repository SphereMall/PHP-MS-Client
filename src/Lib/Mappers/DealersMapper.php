<?php
/**
 * Created by PhpStorm.
 * User: "Dmitriy Vorobey"
 * Date: 27.04.2018
 * Time: 13:31
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Dealer;

/**
 * Class DealersMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class DealersMapper extends Mapper
{
    /**
     * @param array $array
     * @return Dealer
     */
    protected function doCreateObject(array $array)
    {
        $dealer = new Dealer($array);

        if (isset($array['brands'][0])) {
            $mapper        = new BrandsMapper();
            $dealer->brand = $mapper->createObject($array['brands'][0]);
        }

        if (isset($dealer['addresses'])) {
            $mapper            = new AddressesMapper();
            $dealer->addresses = $mapper->createObject($dealer['addresses']);
        }

        return $dealer;
    }
}
