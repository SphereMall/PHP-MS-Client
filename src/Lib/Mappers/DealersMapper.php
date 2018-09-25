<?php
/**
 * Created by PhpStorm.
 * User: "Dmitriy Vorobey"
 * Date: 27.04.2018
 * Time: 13:31
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\AttributeValue;
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

        if (isset($array['brands']) && $brand = reset($array['brands'])) {
            $mapper = new BrandsMapper();
            $dealer->brand = $mapper->createObject($brand);
        }

        if (isset($array['addresses'])) {
            $mapper = new AddressesMapper();
            $addresses = [];
            foreach ($array['addresses'] as $address) {
                $addresses[] = $mapper->createObject($address);
            }

            $dealer->addresses = $addresses;
        }

        $eavs = $array['entityAttributeValues'] ?? [];
        $avs = $array['attributeValues'] ?? [];
        $as = $array['attributes'] ?? [];

        /** @var Attribute[] $attributes */
        $attributes = [];

        foreach ($eavs as $av) {
            if (!isset($attributes[$av['attributeId']]) && isset($as[$av['attributeId']])) {
                $attributes[$av['attributeId']] = new Attribute($as[$av['attributeId']]);
            }

            if (!isset($avs[$av['attributeValueId']])) {
                continue;
            }
            
            $attributes[$av['attributeId']]->values[$av['id']] = new AttributeValue($avs[$av['attributeValueId']]);
        }

        $dealer->attributes = $attributes;

        return $dealer;
    }
}
