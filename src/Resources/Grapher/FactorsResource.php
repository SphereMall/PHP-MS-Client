<?php
/**
 * Created by SergeyBondarchuk.
 * 29.03.2018 18:52
 */

namespace SphereMall\MS\Resources\Grapher;

use SphereMall\MS\Resources\Resource;
use SphereMall\MS\Resources\Traits\DetailResource;

/**
 * Class FactorsResource
 *
 * @package SphereMall\MS\Resources\Grapher
 */
class FactorsResource extends Resource
{
    use DetailResource;

    #region [Override methods]
    public function getURI()
    {
        return "factors";
    }

    /**
     * @param $factorCode
     *
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detailByCode($factorCode)
    {
        $response = $this->handler->handle('GET', false, "detail/code/{$factorCode}");

        return $this->make($response);
    }
    #endregion
}
