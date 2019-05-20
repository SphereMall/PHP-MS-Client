<?php

namespace SphereMall\MS\Resources\Grapher;

use SphereMall\MS\Entities\EntityRelevance;
use SphereMall\MS\Resources\Resource;

/**
 * Class EntityRelevanceResource
 *
 * @package SphereMall\MS\Resources\Grapher
 *
 * @method EntityRelevance get(int $id)
 * @method EntityRelevance first()
 * @method EntityRelevance[] all()
 * @method EntityRelevance update($id, $data)
 * @method EntityRelevance create($data)
 */
class EntityRelevanceResource extends Resource
{
    public function getURI()
    {
        return 'entityrelevance';
    }
}
