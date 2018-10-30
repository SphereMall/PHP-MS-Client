<?php
/**
 * Created by SergeyBondarchuk.
 * 29.03.2018 18:52
 */

namespace SphereMall\MS\Resources\Grapher;


use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Resources\Resource;

/**
 * Class FactorsResource
 * @package SphereMall\MS\Resources\Grapher
 */
class FactorsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "factors";
    }
    #endregion

    /**
     * Get list of entities
     *
     * @param null|int|string $param
     *
     * @return Entity|Entity[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @deprecated
     */
    public function full($param = null)
    {
        $uriAppend = 'full';
        $params    = $this->getQueryParams();

        if (!is_null($param)) {
            $uriAppend = $uriAppend . "/$param";
        }

        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response);
    }

    public function detail($factorId)
    {
        $response = $this->handler->handle('GET', false, "detail/code/{$factorId}");

        return $this->make($response);
    }

    public function detailByCode($factorCode)
    {
        $response = $this->handler->handle('GET', false, "detail/code/{$factorCode}");

        return $this->make($response);
    }
}