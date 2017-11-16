<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\DeliveryProvider;
use SphereMall\MS\Resources\Resource;

/**
 * Class DeliveryProvidersResource
 * @package SphereMall\MS\Resources\Shop
 * @method DeliveryProvider get(int $id)
 * @method DeliveryProvider[] all()
 * @method DeliveryProvider update($id, $data)
 * @method DeliveryProvider create($data)
 */
class DeliveryProvidersResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "deliveryproviders";
    }
    #endregion
}