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
use SphereMall\MS\Lib\Http\Response;
use SphereMall\MS\Lib\Mappers\OrdersMapper;

/**
 * Class OrderHistoryMaker
 * @package SphereMall\MS\Lib\Makers
 */
class OrderHistoryMaker extends ObjectMaker
{
    #region [Protected methods]
    /**
     * @param Response $response
     *
     * @return array
     * @throws EntityNotFoundException
     */
    protected function getResultFromResponse(Response $response)
    {
        $result = [];

        $included = $this->getIncludedArray($response->getIncluded());

        foreach ($response->getData() as $element) {
            $mapperClass = $this->getMapperClass($element);

            if (is_null($mapperClass)) {
                throw new EntityNotFoundException("Entity mapper class for {$element['type']} was not found");
            }

            $result[] = $this->createObject($mapperClass, $element, $included);
        }

        return $result;
    }

    /**
     * @param $type
     *
     * @return null|string
     */
    protected function getMapperClass($type)
    {
        return OrdersMapper::class;
    }

    /**
     * @param array $item
     *
     * @return array
     */
    protected function getAttributes(array $item)
    {
        return $item;
    }
    #endregion
}
