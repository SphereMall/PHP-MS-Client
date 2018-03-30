<?php

namespace SphereMall\MS\Lib\Makers;

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
}