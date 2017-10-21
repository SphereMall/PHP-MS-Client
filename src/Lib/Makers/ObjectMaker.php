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
use SphereMall\MS\Response;

class ObjectMaker implements Maker
{
    #region [Public methods]
    /**
     * @param Response $response
     * @return array
     * @throws EntityNotFoundException
     */
    public function make(Response $response)
    {
        $result = [];

        if (!$response->getSuccess()) {
            return $result;
        }

        foreach ($response->getData() as $element) {
            if ($entityClass = $this->getEntityClass($element['type'])) {
                $item = $this->getAttributes($element);
                $result[] = new $entityClass($item);

                continue;
            }

            throw new EntityNotFoundException("Entity class was not found");
        }

        return $result;
    }
    #endregion

    #region [Private methods]
    /**
     * @param $type
     * @return bool|string
     */
    private function getEntityClass($type)
    {
        $potentialEndpointClass = 'SphereMall\\MS\\Entities\\' . ucfirst($type);
        if (class_exists($potentialEndpointClass)) {
            return $potentialEndpointClass;
        }

        return false;
    }

    /**
     * @param array $item
     * @return array|mixed
     */
    private function getAttributes(array $item)
    {
        if (isset($item['attributes']) && is_array($item['attributes'])) {
            return $item['attributes'];
        }
        return [];
    }
    #endregion
}