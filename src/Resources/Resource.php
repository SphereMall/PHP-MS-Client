<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:07
 */

namespace SphereMall\MS\Resources;

use PHPUnit\Runner\Exception;
use SphereMall\MS\Client;
use SphereMall\MS\Entities\Products;
use SphereMall\MS\RequestHandler;
use SphereMall\MS\Response;

abstract class Resource
{
    #region [Properties]
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var RequestHandler
     */
    private $handler;
    /**
     * @var int
     */
    private $offset = 0;
    /**
     * @var int
     */
    private $limit = 10;
    /**
     * @var array
     */
    private $ids = [];
    #endregion

    #region [Constructor]
    /**
     * BaseService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;

        /** @var Resource $this */
        $this->handler = new RequestHandler($this->client, $this);
    }
    #endregion

    #region [Abstract methods]
    abstract function getURI();
    #endregion

    #region [Query methods]
    /**
     * @param $offset
     * @param $limit
     * @return $this
     */
    public function limit($offset, $limit)
    {
        $this->limit = $limit;
        $this->offset = $offset;

        return $this;
    }

    /**
     * @param array $ids
     * @return $this
     */
    public function ids(array $ids)
    {
        $this->ids = $ids;
        return $this;
    }
    #endregion

    #region [CRUD]
    /**
     * Get list of entities
     * @return array
     */
    public function all()
    {
        $params = [
            'offset' => $this->offset,
            'limit'  => $this->limit,
        ];

        if($this->ids) {
            $params['ids'] = implode(',', $this->ids);
        }

        $response = $this->handler->handle('get', $params);
        if (!$response->getSuccess()) {
            return [];
        }

        return $this->make($response);
    }
    #endregion

    #region [Private methods]
    private function make(Response $response)
    {
        $result = [];
        foreach ($response->getData() as $item) {
            if ($entityClass = $this->getEntityClass($item['type'])) {
                $result[] = new $entityClass($item);

                continue;
            }

            throw new Exception("Entity class was not found");
        }

        return $result;
    }

    private function getEntityClass($type)
    {
        $potentialEndpointClass = 'SphereMall\\MS\\Entities\\' . ucfirst($type);
        if (class_exists($potentialEndpointClass)) {
            return $potentialEndpointClass;
        }

        return false;
    }
    #endregion
}