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
use SphereMall\MS\Registry;
use SphereMall\MS\Services\Products\Entities\Product;

abstract class BaseService
{
    #region [Properties]
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

    #region [Abstract methods]
    abstract static function registry();
    #endregion

    #region [CRUD]
    public function getList()
    {
        $result = $this->client->execute($this->entityName::getEntityName());
        return [new Product(), new Product()];
    }
    #endregion

    #region [Protected methods]
    /**
     * @param string $entityName
     */
    protected static function registryEntity(string $entityName)
    {
        Registry::set($entityName, static::class);
    }
    #endregion
}