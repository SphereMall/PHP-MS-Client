<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 12/22/2017
 * Time: 11:38 AM
 */

namespace SphereMall\MS\Resources\Traits;

use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Http\Request;

/**
 * Trait FullResource
 * @package SphereMall\MS\Resources\Traits
 * @property Request $handler
 */
trait FullResource
{
    /**
     * @return Entity[]
     */
    public function fullAll()
    {
        return $this->full();
    }

    /**
     * @param int $id
     * @return Entity
     * @throws EntityNotFoundException
     */
    public function fullById(int $id)
    {
        $all = $this->full($id);
        return $this->checkAndReturnResult($all);
    }

    /**
     * @param string $code
     * @return Entity
     * @throws EntityNotFoundException
     */
    public function fullByCode(string $code)
    {
        $all = $this->full($code);
        return $this->checkAndReturnResult($all);
    }

    /**
     * Get list of entities
     * @param null|int|string $param
     * @return Entity|Entity[]
     */
    public function full($param = null)
    {
        $uriAppend = 'full';
        $params = $this->getQueryParams();

        if (!is_null($param)) {
            $uriAppend = is_int($param)
                ? $uriAppend . "/$param"
                : "url/$param";
        }

        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response);
    }
    #endregion

    #region [Protected methods]
    /**
     * @param $all
     * @return Entity
     * @throws EntityNotFoundException
     */
    protected function checkAndReturnResult($all)
    {
        if (empty($all[0])) {
            throw new EntityNotFoundException(sprintf("Entity[%s] full with was not found!",
                get_called_class()));
        }

        return $all[0];
    }
    #endregion
}