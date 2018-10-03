<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 03.10.18
 * Time: 16:35
 */

namespace SphereMall\MS\Lib\Makers;


use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Http\Response;

class ElasticSearchGroupByMaker extends ElasticSearchMaker
{
    /**
     * @param Response $response
     *
     * @return array
     * @throws EntityNotFoundException
     */
    public function getResultFromResponse(Response $response)
    {
        $buckets = $response->getData()['aggregations']['variant']['buckets'];

        foreach ($buckets as $bucket) {

            $source = $bucket['value']['hits']['hits'][0]['_source'];

            $data = json_decode($source['scope'], true);
            $element = $data['data'][0];
            $included = $data['included'];

            $included = $this->getIncludedArray($included);
            $mapperClass = $this->getMapperClass($element['type']);

            if (is_null($mapperClass)) {
                throw new EntityNotFoundException("Entity mapper class for {$element['type']} was not found");
            }

            $element['attributes'] = array_merge($element['attributes'], $source);
            $result[] = $this->createObject($mapperClass, $element, $included);
        }

        return $result ?? [];
    }
}
