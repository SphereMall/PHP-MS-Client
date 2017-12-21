<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/21/2017
 * Time: 5:26 PM
 */

namespace SphereMall\MS\Lib\Makers;

use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Http\Meta;
use SphereMall\MS\Lib\Http\Response;
use SphereMall\MS\Lib\Mappers\Mapper;
use SphereMall\MS\Lib\Mappers\OrdersMapper;

class OrderHistoryMaker extends ObjectMaker
{
    #region [Protected methods]
    /**
     * @param $type
     * @return null|string
     */
    protected function getMapperClass($type)
    {
        return OrdersMapper::class;
    }

    /**
     * @param array $item
     * @return array
     */
    protected function getAttributes(array $item)
    {
        return $item;
    }
    #endregion
}