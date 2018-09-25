<?php

namespace SphereMall\MS\Lib\Makers;

use SphereMall\MS\Entities\ElasticIndexer;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Http\Response;

/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 30.03.2018
 * Time: 10:22
 */

class ElasticIndexerResponseMaker extends ObjectMaker{

    /**
     * @param Response $response
     * @return array|null|\SphereMall\MS\Entities\Entity
     */
    public function makeSingle(Response $response)
    {
        if (!$response->getSuccess()) {
            return null;
        }

        return $response->getData();
    }

    /**
     * @param Response $response
     *
     * @return array
     * @throws EntityNotFoundException
     */
    protected function getResultFromResponse(Response $response)
    {
        $result = [];

        foreach ($response->getData() as $element) {
            $item = $this->getAttributes($element);
            $item['type'] = $element['type'];
            $result[] = new ElasticIndexer($item);
        }

        return $result;
    }
}
