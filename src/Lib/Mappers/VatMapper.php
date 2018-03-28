<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Vat;

/**
 * Class VatMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class VatMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return Vat
     */
    protected function doCreateObject(array $array)
    {
        return new Vat($array);
    }
    #endregion
}
