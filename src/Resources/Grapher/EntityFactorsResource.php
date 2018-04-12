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
     *
     * @return Entity|Entity[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function set($entityToCode , $entityId, array $factorValueIds)
    {
        $uriAppend = 'set';

        $params = array_merge($this->getQueryParams(), [
            'entityToCode'      => $entityToCode,
            'entityId'          => $entityId,
            'factorValueIds'    => implode(',', $factorValueIds)
        ]);

        $response = $this->handler->handle('POST', false, $uriAppend, $params);

        return $this->make($response);
    }


}