<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

abstract class Mapper
{
    #region [Public methods]
    public function createObject($array)
    {
        return $this->doCreateObject($array);
    }
    #endregion

    #region [Abstract methods]
    protected abstract function doCreateObject(array $array);
    #endregion
}