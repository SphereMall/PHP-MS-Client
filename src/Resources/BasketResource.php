<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources;

use SphereMall\MS\Entities\Entity;

class BasketResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "basket";
    }
    #endregion

    #region [Override CRUD]
    /**
     * Get entity by id
     * @param int $id
     * @return Entity
     */
    public function get(int $id)
    {
        $params = [];

        if ($this->fields) {
            $params['fields'] = implode(',', $this->fields);
        }

        $uriAppend = 'byId/' . $id;
        $response = $this->handler->handle('GET', false, $uriAppend, $params);
        $result = $this->make($response);

        //TODO: Add additional wrapper or check for one element
        return $result->current();
    }

    /**
     * @param $data
     * @return Entity
     */
    public function new($data)
    {
        $response = $this->handler->handle('POST', $data, 'new');
        $result = $this->make($response);

        return $result->current();
    }

    /**
     * @param array $params
     * @return array|\SphereMall\MS\Lib\Collection
     */
    public function removeItems(array $params)
    {
        $response = $this->handler->handle('DELETE', $params);

        return $this->make($response);
    }

    /**
     * @param $id
     * @param $data
     * @return array|\SphereMall\MS\Lib\Collection
     */
    public function update($id, $data)
    {
        $response = $this->handler->handle('PUT', $data);
        return $this->make($response);
    }
    #endregion
}