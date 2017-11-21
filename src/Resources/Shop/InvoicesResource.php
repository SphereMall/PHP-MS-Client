<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\Invoice;
use SphereMall\MS\Resources\Resource;

/**
 * Class InvoicesResource
 * @package SphereMall\MS\Resources\Shop
 * @method Invoice get(int $id)
 * @method Invoice[] all()
 * @method Invoice update($id, $data)
 * @method Invoice create($data)
 */
class InvoicesResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "invoices";
    }
    #endregion
}