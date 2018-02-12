<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Invoice;

/**
 * Class InvoicesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class InvoicesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return Invoice
     */
    protected function doCreateObject(array $array)
    {
        return new Invoice($array);
    }
    #endregion
}
