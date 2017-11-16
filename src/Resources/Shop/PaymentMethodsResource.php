<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\PaymentMethod;
use SphereMall\MS\Resources\Resource;

/**
 * Class PaymentMethodsResource
 * @package SphereMall\MS\Resources\Shop
 * @method PaymentMethod get(int $id)
 * @method PaymentMethod[] all()
 * @method PaymentMethod update($id, $data)
 * @method PaymentMethod create($data)
 */
class PaymentMethodsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "paymentmethods";
    }
    #endregion
}