<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:21
 */


namespace SphereMall\MS\Services;

use SphereMall\MS\Client;

abstract class BaseService
{
    #refion [Properties]
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var string
     */
    private $entityName;
    #endregion

    #region [Constructor]
    /**
     * BaseService constructor.
     * @param Client $client
     * @param string $entityName
     */
    public function __construct(Client $client, string $entityName)
    {
        $this->client = $client;
        $this->entityName = $entityName;
    }
    #endregion

    #region [CRUD]
    public function getList()
    {
        $class = $this->entityName;
        $result = $this->client->execute($class::getEntityName());

        return [new $class(), new $class()];
    }
    #endregion
}