<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy Vorobey
 * Date: 02.04.2019
 * Time: 13:41
 */

namespace SphereMall\MS\Lib\Makers;

use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Http\Response;
use SphereMall\MS\Lib\Mappers\Mapper;

/**
 * Class EntitiesCorrelationMaker
 *
 * @package SphereMall\MS\Lib\Makers
 */
class EntitiesCorrelationMaker extends ObjectMaker
{
    /**
     * @param $mapperClass
     * @param $element
     * @param $included
     *
     * @return mixed
     */
    protected function createObject($mapperClass, $element, $included)
    {
        /** @var Mapper $mapper */
        $mapper = new $mapperClass;

        return $mapper->createObject(array_merge($this->getAttributes($element), $included));
    }

    /**
     * @param Response $response
     *
     * @return array
     * @throws EntityNotFoundException
     */
    protected function getResultFromResponse(Response $response)
    {
        $included     = $this->getIncludedArray($response->getIncluded());
        $includedFull = $this->getIncludedArray($response->getIncluded(), false);

        $result = [];
        foreach ($response->getData() as $element) {
            $type   = $element['attributes']['type'];
            $entity = $includedFull[$type][$element['attributes'][substr($type, 0, -1) . 'Id']];

            if (is_null($mapperClass = $this->getMapperClass($type))) {
                throw new EntityNotFoundException("Entity mapper class for $type was not found");
            }

            $result[] = $this->createObject($mapperClass, $entity, $included);
        }

        return $result;
    }
}
