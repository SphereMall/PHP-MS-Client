<?php
/**
 * Created by PhpStorm.
 * User: SergeyBondarchuk
 * Date: 11.01.2018
 * Time: 17:29
 */

namespace SphereMall\MS\Resources\Grapher;


use SphereMall\MS\Resources\Resource;

/**
 * Class GrapherResource
 * @package SphereMall\MS\Resources\Grapher
 */
abstract class GrapherResource extends Resource
{

    #region [Protected methods]
    /**
     * @param array $additionalParams
     *
     * @return array|mixed
     */
    protected function getQueryParams(array $additionalParams = [])
    {
        $params = parent::getQueryParams($additionalParams);

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
