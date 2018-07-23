<?php
/**
 * Created by SergeyBondarchuk.
 * 20.07.2018 11:57
 */

namespace SphereMall\MS\Resources\Traits;

use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Http\Request;

/**
 * Class DetailResource
 * @package SphereMall\MS\Resources\Traits
 * @property Request $handler
 */
trait DetailResource
{
    /**
     * @return Entity[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detailAll()
    {
        $uriAppend = 'detail/list';
        $params    = $this->getQueryParams();

        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response);
    }

    /**
     * @param int $id
     *
     * @return Entity
     * @throws EntityNotFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detailById(int $id)
    {
        $all = $this->detail($id);

        return $this->checkAndReturnSingleResult($all);
    }

    /**
     * @param string $code
     *
     * @return Entity
     * @throws EntityNotFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detailByCode(string $code)
    {
        $all = $this->detail($code);

        return $this->checkAndReturnSingleResult($all);
    }

    /**
     * Get list of entities
     *
     * @param null|int|string $param
     *
     * @return Entity|Entity[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detail($param = null)
    {
        $uriAppend = 'detail';
        $params    = $this->getQueryParams();

        if (!is_null($param)) {
            $uriAppend .= is_int($param) ? "/$param" : "/url/$param";
        }

        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response);
    }
    #endregion

    #region [Protected methods]
    /**
     * @param $all
     *
     * @return Entity
     * @throws EntityNotFoundException
     */
    protected function checkAndReturnSingleResult($all)
    {
        if (empty($all[0])) {
            throw new EntityNotFoundException(sprintf("Entity[%s] full with was not found!", get_called_class()));
        }

        return $all[0];
    }
    #endregion
}
