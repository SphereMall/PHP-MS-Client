<?php
/**
 * Created by PHPStorm.
 * User: Yurii Koida
 * Email: y.koida@spheremall.com
 * Date: 04/10/2018
 * Time: 16:16 PM
 */

namespace SphereMall\MS\Resources\Grapher;


use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Resources\Resource;

/**
 * Class FactorsResource
 * @package SphereMall\MS\Resources\Grapher
 */
class EntityFactorsResource extends Resource
{
    #region [Override methods]
    /**
     * @return string
     */
    public function getURI()
    {
        return "entityfactors";
    }

    /**
     * @param $data
     *
     * @throws MethodNotFoundException
     */
    public function create($data)
    {
        throw new MethodNotFoundException("Method create() can not be use with product price configurations");
    }

    /**
     * @param int $id
     *
     * @throws MethodNotFoundException
     */
    public function get(int $id)
    {
        throw new MethodNotFoundException("Method get() can not be use with product price configurations");
    }

    /**
     * @param $id
     * @param $data
     *
     * @throws MethodNotFoundException
     */
    public function update($id, $data)
    {
        throw new MethodNotFoundException("Method update() can not be use with product price configurations");
    }

    /**
     * @param $id
     *
     * @return bool|void
     * @throws MethodNotFoundException
     */
    public function delete($id)
    {
        throw new MethodNotFoundException("Method delete() can not be use with product price configurations");
    }
    #endregion

    /**
     * Get list factor values for current entity
     *
     * @param string $entityCode
     * @param int $entityId
     *
     * @return Entity|Entity[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function list($entityCode, $entityId, $param = null)
    {
        $entityCode = strtolower($entityCode);
        $uriAppend  = "{$entityCode}/{$entityId}";

        $params     = $this->getQueryParams();
        $response   = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response);
    }

    /**
     * Set factor value for current entity
     *
     * @param string $entityToCode
     * @param int $entityId
     * @param int|array $factorValueIds
     * @param int $factorId
     *
     * @return Entity|Entity[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function set($entityToCode , $entityId, array $factorValueIds, $factorId)
    {
        $uriAppend = 'set';

        $params = array_merge($this->getQueryParams(), [
            'entityId'       => $entityId,
            'entityToCode'   => $entityToCode,
            'factorValueIds' => implode(',', $factorValueIds),
            'factorId'       => $factorId
        ]);

        $response = $this->handler->handle('POST', $params, $uriAppend);

        return $this->make($response);
    }

    /**
     * @param $entityCode
     * @param $entityId
     * @return bool
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteFactors($entityCode, $entityId)
    {
        $response = $this->handler->handle('DELETE', false, "{$entityCode}/{$entityId}");
        if (!$response->getSuccess()) {
            throw new EntityNotFoundException($response->getErrorMessage());
        }

        return $response->getSuccess();
    }

    /**
     * @param $entityCode
     * @param $entityId
     * @param $factorValueId
     * @return bool
     * @throws EntityNotFoundException
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteFactor($entityCode, $entityId, $factorValueId)
    {
        $response = $this->handler->handle('DELETE', false, "{$entityCode}/{$entityId}/{$factorValueId}");
        if (!$response->getSuccess()) {
            throw new EntityNotFoundException($response->getErrorMessage());
        }

        return $response->getSuccess();
    }

}