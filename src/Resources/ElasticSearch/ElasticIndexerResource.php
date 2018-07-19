<?php
namespace SphereMall\MS\Resources\ElasticSearch;

use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Resources\Resource;

/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 30.03.2018
 * Time: 10:00
 */

class ElasticIndexerResource extends Resource{

    /**
     * @return string
     */
    public function getURI()
    {
        return 'elasticsearch';
    }

    /**
     * @return array
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function runIndex(){
        $params = $this->getQueryParams();
        $response = $this->handler->handle('GET', null, 'runindex', $params);
        return $this->make($response, false);

    }

    /**
     * @return array
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function reindex(){
        $params = $this->getQueryParams();
        $response = $this->handler->handle('GET', null, 'reindex', $params);
        return $this->make($response, false);
    }

    /**
     * @return array
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteIndex()
    {
        $response = $this->handler->handle('DELETE', null, 'delete');
        return $this->make($response, false);
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