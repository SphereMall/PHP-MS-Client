<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Grapher;

use Exception;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Helpers\CorrelationTypeHelper;
use SphereMall\MS\Lib\Makers\EntitiesCorrelationMaker;

/**
 * Class GridResource
 * @package SphereMall\MS\Resources\Users
 */
class CorrelationsResource extends GrapherResource
{
    #region [Override methods]
    /**
     * @return string
     */
    public function getURI()
    {
        return "correlations";
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     */
    public function get(int $id)
    {
        throw new MethodNotFoundException("Method get() can not be use with correlations");
    }

    /**
     * @param $id
     * @param $data
     *
     * @throws Exception
     */
    public function update($id, $data)
    {
        throw new MethodNotFoundException("Method update() can not be use with correlations");
    }

    /**
     * @param $data
     *
     * @throws Exception
     */
    public function create($data)
    {
        throw new MethodNotFoundException("Method create() can not be use with correlations");
    }

    /**
     * @param $id
     *
     * @return bool|void
     * @throws Exception
     */
    public function delete($id)
    {
        throw new MethodNotFoundException("Method delete() can not be use with correlations");
    }
    #endregion

    /**
     * @param int    $id
     * @param string $forClassName
     *
     * @return array|Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getById(int $id, string $forClassName)
    {
        $params = $this->getQueryParams();

        $type      = CorrelationTypeHelper::getGraphTypeByClass($forClassName);
        $uriAppend = "{$type}/{$id}";

        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response);
    }

    /**
     * @param string $entityFrom
     * @param array  $entityIds
     *
     * @param array  $filterParams
     *
     * @return array|int|Entity|Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFromEntityByIds(string $entityFrom, array $entityIds, array $filterParams = [])
    {
        $uriAppend = "from/{$entityFrom}";
        $params    = ['entityIds' => implode(",", $entityIds)];
        if ($filterParams) {
            $params['params'] = json_encode([$filterParams]);
        }

        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response, true, new EntitiesCorrelationMaker);
    }
}
