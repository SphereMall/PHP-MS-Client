<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 26.04.2018
 * Time: 9:58
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\Rule;
use SphereMall\MS\Resources\Resource;


/**
 * Class RulesResource
 * @package SphereMall\MS\Resources\Shop
 * @method Rule get(int $id)
 * @method Rule first()
 * @method Rule[] all()
 * @method Rule update($id, $data)
 * @method Rule create($data)
 */
class RulesResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "rules";
    }
    #endregion
}