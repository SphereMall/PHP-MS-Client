<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/8/2017
 * Time: 2:52 PM
 */

namespace SphereMall\MS;

use SphereMall\MS\Exceptions\ConfigurationException;
use SphereMall\MS\Services\BaseService;
use SphereMall\MS\Services\Products\ProductService;

class Client
{
    #region [Properties]
    /**
     * @var string
     */
    protected $gatewayUrl;
    /**
     * @var string
     */
    protected $clientId;
    /**
     * @var string
     */
    protected $secretKey;
    /**
     * @var string
     */
    protected $version = 'v1';

    /**
     * @var array
     */
    protected $services;

    /**
     * @var array
     */
    protected $calledService;
    #endregion

    #region [Constructor]
    /**
     * Client constructor.
     * @param array $options
     * @throws ConfigurationException
     */
    public function __construct(array $options = [])
    {
        //Set all options from client side
        foreach ($options as $optionKey => $optionValue) {
            if (property_exists($this, $optionKey)) {
                $this->{$optionKey} = $optionValue;
            }
        }

        //Check if main options have been set
        if (!$this->gatewayUrl || !$this->clientId || !$this->secretKey) {
            throw new ConfigurationException("API connection data not set");
        }

        //Registry all available services
        $this->registryServices();
    }
    #endregion

    #region [Getters methods]
    /**
     * @return string
     */
    public function getGatewayUrl()
    {
        return $this->gatewayUrl;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
    #endregion

    #region [Public methods]
    /**
     * @param string $entityClass
     * @return BaseService
     */
    public function call(string $entityClass)
    {
        $serviceClass = Registry::get($entityClass);
        return new $serviceClass($this, $entityClass);
    }

    public function execute($entity)
    {
        $client = new \GuzzleHttp\Client();

        $url = $this->gatewayUrl . '/' .
            $this->version . '/' .
            $entity;

        //base url should end without slash
        $url = rtrim($url, '/');
        $url = str_replace('/?', '?', $url);

        return new Response($client->request("GET", $url));
    }
    #endregion

    #region [Private methods]
    private function registryServices()
    {
        ProductService::registry();
    }
    #endregion
}