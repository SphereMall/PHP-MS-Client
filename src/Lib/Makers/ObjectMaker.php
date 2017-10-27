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

class ObjectMaker implements Maker
{
    #region [Public methods]
    /**
     * @param Response $response
     * @return Collection
     * @throws EntityNotFoundException
     */
    public function make(Response $response)
    {
        $result = [];

        if (!$response->getSuccess()) {
            return new Collection($result);
        }

        $included = $this->getIncludedArray($response->getIncluded());

        foreach ($response->getData() as $element) {
            if ($mapperClass = $this->getMapperClass($element['type'])) {

                $item = $this->getAttributes($element);
                $relations = $this->getRelationships($element, $included);

                $item = array_merge($item, $relations);
                /**
                 * @var Mapper $mapper
                 */
                $mapper = new $mapperClass();
                $result[] = $mapper->createObject($item);

                continue;
            }

            throw new EntityNotFoundException("Entity class was not found");
        }

        return new Collection($result);
    }
    #endregion

    #region [Protected methods]
    /**
     * @param $type
     * @return bool|string
     */
    protected function getMapperClass($type)
    {
        $potentialEndpointClass = 'SphereMall\\MS\\Lib\\Mappers\\' . ucfirst($type) . 'Mapper';
        if (class_exists($potentialEndpointClass)) {
            return $potentialEndpointClass;
        }

        return false;
    }

    /**
     * @param array $item
     * @return array|mixed
     */
    protected function getAttributes(array $item)
    {
        if (isset($item['attributes']) && is_array($item['attributes'])) {
            return $item['attributes'];
        }
        return [];
    }

    /**
     * Get relationships from array
     * @param array $item
     * @param array $included
     * @return array
     */
    protected function getRelationships(array $item, array $included)
    {
        $relations = [];
        if (isset($item['relationships']) && is_array($item['relationships'])) {
            $relations = $item['relationships'];
        }

        $result = [];
        foreach ($relations as $relationKey => $relationValue) {
            foreach ($relationValue['data'] as $relationData) {
                $result[$relationKey][] = $included[$relationData['type']][$relationData['id']];
            }
        }

        return $result;
    }

    /**
     * Prepare array of included data, we walk through ONCE
     * result example: ['brands'][706] = {attributes}
     * @param array $included
     * @return array
     */
    protected function getIncludedArray(array $included)
    {
        $result = [];
        foreach ($included as $include) {
            $result[$include['type']][$include['id']] = $include['attributes'];
        }

        return $result;
    }
    #endregion
}