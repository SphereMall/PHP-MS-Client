<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 01.05.2018
 * Time: 12:49
 */

namespace SphereMall\MS\Resources\Shop;


use SphereMall\MS\Entities\DiscountType;
use SphereMall\MS\Resources\Resource;

/**
 * Class DiscountTypesResource
 * @package SphereMall\MS\Resources\Shop\
 * @method DiscountType get(int $id)
 * @method DiscountType first()
 * @method DiscountType[] all()
 * @method DiscountType update($id, $data)
 * @method DiscountType create($data)
 */
class DiscountTypesResource extends Resource
{
    /**
     * @return string
     */
    public function getURI()
    {
        return "discounttypes";
    }
}
