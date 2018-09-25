<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 25.09.2018
 * Time: 11:46
 */

namespace SphereMall\MS\Resources\Comments;


use SphereMall\MS\Lib\Filters\FilterOperators;
use SphereMall\MS\Resources\Resource;

class EntitiesAverageRating extends Resource
{

    function getURI()
    {
        return 'entitiesaveragerating';
    }

    public function getAvgRating(int $objectId, int $entityId)
    {
        $this->filter(['objectId' => [FilterOperators::EQUAL => $objectId], 'entityId' => [FilterOperators::EQUAL => $entityId]]);
        $params = $this->getQueryParams();

        $response = $this->handler->handle('GET', false, 'by', $params);

        if (!$response->getSuccess()) {
            return 0;
        }

        $data = $response->getData();

        return (int)$data[0]['attributes']['averageRating'] ?? 0;
    }
}