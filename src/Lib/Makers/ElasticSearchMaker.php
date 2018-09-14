<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 19.02.2018
 * Time: 16:44
 */

namespace SphereMall\MS\Lib\Makers;

use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Http\ElasticSearchResponse;
use SphereMall\MS\Lib\Http\Response;
use SphereMall\MS\Lib\Http\Meta;

// ToDo: extends Maker or ObjectMaker with overriding

/**
 * Class ElasticSearchMaker
 * @package SphereMall\MS\Lib\Makers
 *
 * @property bool $asCollection
 */
class ElasticSearchMaker extends ObjectMaker
{

    protected $asCollection = false;

    /**
     * @param Response $response
     * @return mixed|null
     * @throws EntityNotFoundException
     */
    public function makeSingle(Response $response)
    {
        if (!$response->getSuccess()) {
            return null;
        }

        $result = $this->getResultFromResponse($response);

        return $result[0] ?? null;
    }

    /**
     * @param Response $response
     * @return array|Collection
     * @throws EntityNotFoundException
     */
    public function makeArray(Response $response)
    {
        if (!$response->getSuccess()) {
            if ($this->asCollection) {
                return new Collection([], new Meta());
            }

            return [];
        }

        $result = $this->getResultFromResponse($response);

        if ($this->asCollection) {
            return new Collection($result, $response->getMeta());
        }

        return $result;
    }


    /**
     * @param Response $response
     * @return array
     * @throws EntityNotFoundException
     */
    protected function getResultFromResponse(Response $response)
    {
        $hits = $response->getData()[0]['hits']['hits'];

        foreach ($hits as $hit) {
            $data = json_decode($hit['_source']['scope'], true);
            $element = $data['data'][0];
            $included = $this->getIncludedArray($data['included']);
            $mapperClass = $this->getMapperClass($element['type']);

            if (is_null($mapperClass)) {
                throw new EntityNotFoundException("Entity mapper class for {$element['type']} was not found");
            }

            $result[] = $this->createObject($mapperClass, $element, $included);
        }

        return $result ?? [];
    }
}
