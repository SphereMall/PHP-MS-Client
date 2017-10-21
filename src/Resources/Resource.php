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
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Entities\Products;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Makers\Maker;
use SphereMall\MS\Lib\Makers\ObjectMaker;
use SphereMall\MS\Request;
use SphereMall\MS\Response;

abstract class Resource
{
    #region [Properties]
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Request
     */
    private $handler;
    /**
     * @var Maker
     */
    private $maker;
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
    /**
     * @var array
     */
    private $fields = [];
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
        $this->handler = new Request($this->client, $this);

        $this->maker = new ObjectMaker();
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
    public function limit($limit = 10, $offset = 0)
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

    /**
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }
    #endregion

    #region [CRUD]
    /**
     * Get entity by id
     * @param int $id
     * @return Entity
     * @throws EntityNotFoundException
     */
    public function get(int $id)
    {
        $params = [];

        if ($this->fields) {
            $params['fields'] = implode(',', $this->fields);
        }

        $response = $this->handler->handle('get', false, $id, $params);
        $result = $this->make($response);
        //TODO: Add additional wrapper or check for one element
        return $result[0];
    }

    /**
     * Get list of entities
     * @return array
     * @throws EntityNotFoundException
     */
    public function all()
    {
        $params = [
            'offset' => $this->offset,
            'limit'  => $this->limit,
        ];

        if ($this->ids) {
            $params['ids'] = implode(',', $this->ids);
        }

        if ($this->fields) {
            $params['fields'] = implode(',', $this->fields);
        }

        $response = $this->handler->handle('get', false, false, $params);
        return $this->make($response);
    }
    #endregion

    #region [Private methods]
    /**
     * @param Response $response
     * @return array
     * @throws EntityNotFoundException
     */
    private function make(Response $response)
    {
        $this->clearExtraDataForCall();
        return $this->maker->make($response);
    }

    private function clearExtraDataForCall()
    {
        $this->limit = 10;
        $this->offset = 0;

        $this->ids = [];
        $this->fields = [];
    }
    #endregion
}