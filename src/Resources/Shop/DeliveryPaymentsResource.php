<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\DeliveryPaymentRelation;
use SphereMall\MS\Resources\Resource;

/**
 * Class DeliveryPaymentsResource
 * @package SphereMall\MS\Resources\Shop
 * @method DeliveryPaymentRelation get(int $id)
 * @method DeliveryPaymentRelation first()
 * @method DeliveryPaymentRelation[] all()
 * @method DeliveryPaymentRelation update($id, $data)
 * @method DeliveryPaymentRelation create($data)
 */
class DeliveryPaymentsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "deliverypaymentrelations";
    }
    #endregion
}