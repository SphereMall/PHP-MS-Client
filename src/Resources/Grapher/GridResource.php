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
use SphereMall\MS\Resources\Resource;

/**
 * Class GridResource
 * @package SphereMall\MS\Resources\Users
 */
class GridResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "grid";
    }
    #endregion

    #region [Override methods]
    public function all()
    {
        $response = $this->handler->handle('GET');
        return $this->make($response);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function get(int $id)
    {
        throw new Exception("Method get() can not be use with GRID");
    }

    /**
     * @param $id
     * @param $data
     * @throws Exception
     */
    public function update($id, $data)
    {
        throw new Exception("Method update() can not be use with GRID");
    }

    /**
     * @param $data
     * @throws Exception
     */
    public function create($data)
    {
        throw new Exception("Method create() can not be use with GRID");
    }

    /**
     * @param $id
     * @return bool|void
     * @throws Exception
     */
    public function delete($id)
    {
        throw new Exception("Method delete() can not be use with GRID");
    }
    #endregion

    #region [Public methods]

    #endregion
}