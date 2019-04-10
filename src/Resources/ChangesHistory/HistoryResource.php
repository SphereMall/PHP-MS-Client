<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 01.04.2019
 * Time: 10:31
 */

namespace SphereMall\MS\Resources\ChangesHistory;

use SphereMall\MS\Entities\History;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Resources\Resource;

/**
 * Class HistoryResource
 *
 * @package SphereMall\MS\Resources\ChangesHistory
 * @method History get(int $id)
 * @method History first()
 * @method History[] all()
 * @method History update($id, $data)
 * @method History create($data)Action
 * @method History|History[] detail($param = null)
 */
class HistoryResource extends Resource
{

    function getURI()
    {
        return "history";
    }

    /**
     * @param string $entity
     * @param int    $objectId
     *
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws EntityNotFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getHistoryByEntityAndId(string $entity, int $objectId)
    {
        $params = $this->getQueryParams();

        $uriAppend = "$entity/$objectId";
        $response = $this->handler->handle('GET', false, $uriAppend, $params);
        if (!$response->getSuccess()) {
            throw new EntityNotFoundException($response->getErrorMessage());
        }

        return $this->make($response);
    }

    /**
     * @param string $entity
     * @param int    $entityId
     * @param array  $params
     *
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws EntityNotFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addHistory(string $entity, int $entityId, array $params = [])
    {
        $uriAppend = "$entity/$entityId";
        $response = $this->handler->handle('POST', $params, $uriAppend);
        if (!$response->getSuccess()) {
            throw new EntityNotFoundException($response->getErrorMessage());
        }

        return $this->make($response);
    }
}
