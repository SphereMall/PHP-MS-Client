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
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Filters\Grid\GridFilter;
use SphereMall\MS\Lib\Makers\CountMaker;
use SphereMall\MS\Lib\Specifications\Basic\FilterSpecification;
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
    /**
     * Set filter to the resource selecting
     * @param array|FilterSpecification|GridFilter $filter
     * @return $this
     */
    public function filter($filter)
    {
        if (is_array($filter)) {
            $filter = new GridFilter($filter);
        }

        if ($filter instanceof FilterSpecification) {
            $filter = new GridFilter($filter->asFilter());
        }

        $this->filter = $filter;
        return $this;
    }

    /**
     * @return Entity[]|Collection
     */
    public function all()
    {
        $params = $this->getQueryParams();

        $response = $this->handler->handle('GET', false, false, $params);
        return $this->make($response);
    }

    /**
     * @return int
     */
    public function count()
    {
        $params = $this->getQueryParams();

        $response = $this->handler->handle('GET', false, 'count', $params);
        return $this->make($response, false, new CountMaker());
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

    #region [Protected methods]
    protected function getQueryParams()
    {
        $params = parent::getQueryParams();

        if (empty($params['where'])) {
            return $params;
        }

        foreach (explode('&', $params['where']) as $where) {
            list($key, $value) = explode('=', $where);
            $params[$key] = $value;
        }

        unset($params['where']);
        return $params;
    }
    #endregion
}