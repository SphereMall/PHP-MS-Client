<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Message;

/**
 * Class UserMessagesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class UserMessagesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return Message
     */
    protected function doCreateObject(array $array)
    {
        return new Message($array);
    }
    #endregion
}
