<?php
/**
 * Created by PhpStorm.
 * User: Serhey Yanchevsky
 * Date: 19.02.2018
 * Time: 16:44
 */

namespace SphereMall\MS\Lib\Makers;

use SphereMall\MS\Lib\Http\ElasticSearchResponse;
use SphereMall\MS\Lib\Http\Response;

/**
 * Class ElasticSearchFacetedMaker
 * @package SphereMall\MS\Lib\Makers
 *
 * @property bool $asCollection
 */
class ElasticSearchFacetedMaker extends ElasticSearchMaker
{
    /**
     * @param ElasticSearchResponse $response
     * @return array
     */
    protected function getResultFromResponse(Response $response): array
    {
        $result = [];
        if (!isset($response->getData()['aggregations'])) {
            return $result;
        }
        foreach ($response->getData()['aggregations'] as $fieldName => $aggregation) {
            if ($array = $this->createArray($fieldName, $aggregation)) {
                $result = array_merge($result, $array);
            }
        }

        return $result;
    }

    /**
     * @param string $fieldName
     * @param array $aggregation
     *
     * @return array
     */
    protected function createArray(string $fieldName, array $aggregation): array
    {
        $return = [];
        $buckets = $aggregation['buckets'] ?? $aggregation[$fieldName]['buckets'] ?? null;
        if (!$buckets) {
            return $return;
        }
        $attributeId = $this->isAttribute($fieldName);
        foreach ($buckets as $key => $bucket) {
            $return[$key]['count'] = $bucket['doc_count'];
            $return[$key][($attributeId === false ? $fieldName : 'attributeValueId')] = $bucket['key'];
            if ($attributeId !== false) {
                $return[$key]['attributeId'] = $attributeId;
            }
        }

        return array_values($return);
    }

    /**
     * @param string $name
     *
     * @return bool|mixed
     */
    protected function isAttribute(string $name)
    {
        $searchParam = '_attr';
        if (mb_substr_count($name, $searchParam, 'UTF-8') > 0) {
            return str_replace($searchParam, '', $name);
        }

        return false;
    }
}
