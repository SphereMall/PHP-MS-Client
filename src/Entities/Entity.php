<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:37
 */

namespace SphereMall\MS\Entities;

use SphereMall\MS\Lib\BaseModel;
use SphereMall\MS\Lib\Helpers\ClassReflectionHelper;

/**
 * Class Entity
 * @package SphereMall\MS\Entities
 */
class Entity extends BaseModel
{
    #region [Public methods]

    /**
     * @return string
     */
    public function getType()
    {
        return (new ClassReflectionHelper(get_called_class()))->getShortLowerCaseName();
    }
    #endregion
}