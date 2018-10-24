<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 23.10.2018
 * Time: 17:32
 */

namespace SphereMall\MS\Resources\Users;


use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Lib\Makers\WishListCountMaker;
use SphereMall\MS\Resources\Resource;

class WishListResource extends Resource
{

    function getURI()
    {
        return "users/wishlist";
    }

    /**
     * @param $entityIds
     * @param string $entity
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function getCountInWishList($entityIds, $entity = 'products')
    {
        $data = ['entityIds' => [['ids' => $entityIds, 'entity' => $entity]]];

        $response = $this->handler->handle('POST', $data, 'counts');

        return $this->make($response, true, new WishListCountMaker());
    }

    /**
     * @return array|void
     * @throws MethodNotFoundException
     */
    public function all()
    {
        throw new MethodNotFoundException("Method all() can not be use with Elasticsearch");
    }

    /**
     * @return int|void
     * @throws MethodNotFoundException
     */
    public function count()
    {
        throw new MethodNotFoundException("Method count() can not be use with Elasticsearch");
    }

    /**
     * @param int $id
     * @return array|\SphereMall\MS\Entities\Entity|void
     * @throws MethodNotFoundException
     */
    public function get(int $id)
    {
        throw new MethodNotFoundException("Method get() can not be use with Elasticsearch");
    }

    /**
     * @param $id
     * @param $data
     * @return \SphereMall\MS\Entities\Entity|void
     * @throws MethodNotFoundException
     */
    public function update($id, $data)
    {
        throw new MethodNotFoundException("Method update() can not be use with Elasticsearch");
    }

    /**
     * @param $data
     * @return \SphereMall\MS\Entities\Entity|void
     * @throws MethodNotFoundException
     */
    public function create($data)
    {
        throw new MethodNotFoundException("Method create() can not be use with Elasticsearch");
    }
}