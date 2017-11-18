<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\PaymentProvider;
use SphereMall\MS\Resources\Resource;

/**
 * Class PaymentProvidersResource
 * @package SphereMall\MS\Resources\Shop
 * @method PaymentProvider get(int $id)
 * @method PaymentProvider[] all()
 * @method PaymentProvider update($id, $data)
 * @method PaymentProvider create($data)
 */
class PaymentProvidersResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "paymentproviders";
    }
    #endregion
}