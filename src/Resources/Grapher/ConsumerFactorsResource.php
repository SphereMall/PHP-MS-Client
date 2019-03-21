<?php
namespace SphereMall\MS\Resources\Grapher;

use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Resources\Resource;

/**
 * Class ConsumerFactorsResource
 *
 * @package SphereMall\MS\Resources\Grapher
 */
class ConsumerFactorsResource extends Resource
{
    #region [Override methods]
    /**
     * @return string
     */
    public function getURI()
    {
        return "consumerfactors";
    }

    /**
     * @param $data
     *
     * @throws MethodNotFoundException
     */
    public function create($data)
    {
        throw new MethodNotFoundException("Method create() can not be use with consumer factors");
    }

    /**
     * @param int $id
     *
     * @throws MethodNotFoundException
     */
    public function get(int $id)
    {
        throw new MethodNotFoundException("Method get() can not be use with product consumer factors");
    }

    /**
     * @param $id
     * @param $data
     *
     * @throws MethodNotFoundException
     */
    public function update($id, $data)
    {
        throw new MethodNotFoundException("Method update() can not be use with consumer factors");
    }

    /**
     * @param $id
     *
     * @return bool|void
     * @throws MethodNotFoundException
     */
    public function delete($id)
    {
        throw new MethodNotFoundException("Method delete() can not be use with consumer factors");
    }
    #endregion

    /**
     * Set consumer factors for history and for current entity factors
     *
     * @see https://spheremall.atlassian.net/wiki/spaces/MIC/pages/1272676386/Grapher+2.3.5+Release+Notes
     *
     * @param int   $userId
     * @param array $factors
     * @param array $context
     *
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function set(int $userId, array $factors, array $context)
    {
        $uriAppend = 'set';

        $params = [
            'userId'  => $userId,
            'factors' => $factors,
            'context' => $context,
        ];

        $response = $this->handler->handle('POST', $params, $uriAppend);

        return $this->make($response);
    }
}
