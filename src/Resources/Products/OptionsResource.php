<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Products;

use SphereMall\MS\Entities\Option;
use SphereMall\MS\Resources\Resource;

/**
 * Class OptionsResource
 * @package SphereMall\MS\Resources\Products
 * @method Option get(int $id)
 * @method Option[] all()
 * @method Option update($id, $data)
 * @method Option create($data)
 */
class OptionsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "options";
    }
    #endregion

}