<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/21/2017
 * Time: 5:26 PM
 */

namespace SphereMall\MS\Lib\Makers;

use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Http\Response;
use SphereMall\MS\Lib\Mappers\Mapper;

class CountMaker extends ObjectMaker
{
    #region [Public methods]
    /**
     * @param Response $response
     * @param bool $returnArray
     * @return int
     */
    public function make(Response $response, $returnArray = true)
    {
        if (!$response->getSuccess()) {
            return 0;
        }

        $data = $response->getData();
        if(isset($data[0])){
            $item = $this->getAttributes($data[0]);
            return (int)$item['count'];
        }

        return 0;
    }
    #endregion
}