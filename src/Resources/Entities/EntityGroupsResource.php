<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 08.03.2019
 * Time: 15:16
 */

namespace SphereMall\MS\Resources\Entities;

use SphereMall\MS\Entities\EntityGroup;
use SphereMall\MS\Resources\Resource;
use SphereMall\MS\Resources\Traits\DetailResource;

/**
 * Class EntityGroupsResource
 *
 * @package SphereMall\MS\Resources\Entities
 * @method EntityGroup get(int $id)
 * @method EntityGroup first()
 * @method EntityGroup[] all()
 * @method EntityGroup update($id, $data)
 * @method EntityGroup create($data)
 * @method EntityGroup|EntityGroup[] detail($param = null)
 * @method EntityGroup[] detailAll()
 * @method EntityGroup detailById(int $id)
 * @method EntityGroup detailByCode(string $code)
 */
class EntityGroupsResource extends Resource
{
    use DetailResource;

    function getURI()
    {
        return "entitygroups";
    }
}
