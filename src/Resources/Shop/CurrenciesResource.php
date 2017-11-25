<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\Currency;
use SphereMall\MS\Resources\Resource;

/**
 * Class CurrenciesResource
 * @package SphereMall\MS\Resources\Shop
 * @method Currency get(int $id)
 * @method Currency first()
 * @method Currency[] all()
 * @method Currency update($id, $data)
 * @method Currency create($data)
 */
class CurrenciesResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "currencies";
    }
    #endregion
}