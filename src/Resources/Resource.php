<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:07
 */

namespace SphereMall\MS\Resources;

use SphereMall\MS\Client;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Filters\Filter;
use SphereMall\MS\Lib\Makers\Maker;
use SphereMall\MS\Lib\Makers\ObjectMaker;
use SphereMall\MS\Lib\Http\Request;
use SphereMall\MS\Lib\Http\Response;

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

    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var array
     */
    private $in = [];

    /**
     * @var array
     */
    private $sort = [];
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
     * Set a limit on the number of resource and offset for skipping the number of resource
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
     * Get the resource limit
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Get the resource offset
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Set list of ids for selecting list of resources
     * @param array $ids
     * @return $this
     */
    public function ids(array $ids)
    {
        $this->ids = $ids;
        return $this;
    }

    /**
     * Get list of ids for selecting list of resources
     * @return array
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * Set list of fields for selecting the resource
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * Get list of fields for selecting the resources
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set filter to the resource selecting
     * @param array|Filter $filter
     * @return $this
     */
    public function filter($filter)
    {
        if (is_array($filter)) {
            $filter = new Filter($filter);
        }

        $this->filter = $filter;

        return $this;
    }

    /**
     * Get current filter
     * @return Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param $field
     * @param $values
     * @return $this
     */
    public function in($field, $values)
    {
        $this->in = [$field => $values];

        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function sort($field)
    {
        $this->sort[] = $field;

        return $this;
    }
    #endregion

    #region [CRUD]
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

        $response = $this->handler->handle('get', false, $id, $params);
        $result = $this->make($response);
        //TODO: Add additional wrapper or check for one element
        return $result->current();
    }

    /**
     * Get list of entities
     * @return Collection
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

        if ($this->filter) {
            $params['where'] = (string)$this->filter;
        }

        if ($this->in) {
            $params['in'] = json_encode($this->in);
        }

        if ($this->sort) {
            $params['sort'] = implode(',', $this->sort);
        }

        $response = $this->handler->handle('get', false, 'by', $params);
        return $this->make($response);
    }
    #endregion

    #region [Private methods]
    /**
     * @param Response $response
     * @return Collection
     */
    private function make(Response $response)
    {
        $this->clearExtraDataForCall();
        return $this->maker->make($response);
    }

    private function clearExtraDataForCall()
    {
        /*$this->limit = 10;
        $this->offset = 0;

        $this->ids = [];
        $this->fields = [];
        $this->filter = [];
        $this->in = [];
        $this->sort = [];*/
    }
    #endregion
}