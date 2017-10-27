<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:07
 */

namespace SphereMall\MS\Resources;

use GuzzleHttp\Promise\Promise;
use SphereMall\MS\Client;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Filters\Filter;
use SphereMall\MS\Lib\Makers\CountMaker;
use SphereMall\MS\Lib\Makers\Maker;
use SphereMall\MS\Lib\Makers\ObjectMaker;
use SphereMall\MS\Lib\Http\Request;
use SphereMall\MS\Lib\Http\Response;

/**
 * @property Client $client
 * @property Request $handler
 * @property Maker $maker
 * @property int $offset
 * @property int $limit
 * @property array $ids
 * @property array $fields
 * @property Filter $filter
 * @property array $in
 * @property array $sort
 */
abstract class Resource
{
    #region [Properties]
    protected $client;
    protected $handler;
    protected $maker;
    protected $offset = 0;
    protected $limit = 10;
    protected $ids = [];
    protected $fields = [];
    protected $filter;
    protected $in = [];
    protected $sort = [];
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
     * Set field for sorting
     * @param $field
     * @return $this
     */
    public function sort($field)
    {
        $this->sort[] = $field;

        return $this;
    }

    /**
     * Get fields for sorting
     * @return array
     */
    public function getSort()
    {
        return $this->sort;
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

        $response = $this->handler->handle('GET', false, $id, $params);
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
        $params = $this->getQueryParams();

        $response = $this->handler->handle('GET', false, 'by', $params);

        return $this->make($response);
    }

    public function count()
    {
        $params = $this->getQueryParams();

        $response = $this->handler->handle('GET', false, 'count', $params);
        $maker = new CountMaker();

        return $maker->make($response);
    }

    /**
     * @param $data
     * @return Entity
     */
    public function create($data)
    {
        $response = $this->handler->handle('POST', $data);
        $result = $this->make($response);

        return $result->current();
    }

    /**
     * @param $id
     * @param $data
     * @return Entity
     */
    public function update($id, $data)
    {
        $response = $this->handler->handle('PUT', $data, $id);
        $result = $this->make($response);

        return $result->current();
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $response = $this->handler->handle('DELETE', false, $id);

        return $response->getSuccess();
    }
    #endregion

    #region [Protected methods]
    /**
     * @param Promise|Response $response
     * @return array|Collection
     */
    protected function make($response)
    {
        $this->clearExtraDataForCall();
        if ($response instanceof Response) {
            return $this->maker->make($response);
        }

        return ['promise' => $response, 'maker' => $this->maker];
    }

    protected function getQueryParams()
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

        return $params;
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