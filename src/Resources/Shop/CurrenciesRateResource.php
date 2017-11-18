<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\CurrencyRate;
use SphereMall\MS\Resources\Resource;

/**
 * Class CurrenciesRateResource
 * @package SphereMall\MS\Resources\Shop
 * @method CurrencyRate get(int $id)
 * @method CurrencyRate[] all()
 * @method CurrencyRate update($id, $data)
 * @method CurrencyRate create($data)
 */
class CurrenciesRateResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "currenciesrate";
    }
    #endregion
}