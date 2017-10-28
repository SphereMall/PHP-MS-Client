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
use SphereMall\MS\Lib\ServiceInjector;

/**
 * @property string $gatewayUrl
 * @property string $clientId
 * @property string $secretKey
 * @property string $version
 * @property array $services
 * @property array $calledService
 * @property bool $async
 * @property callable|null $beforeAPICall
 * @property callable|null $afterAPICall
 */
class Client
{
    use ServiceInjector;

    #region [Properties]
    protected $gatewayUrl;
    protected $clientId;
    protected $secretKey;
    protected $version = 'v1';
    protected $services;
    protected $calledService;

    protected $async = false;
    protected $promises = [];

    public $beforeAPICall;
    public $afterAPICall;
    #endregion

    #region [Constructor]
    /**
     * Client constructor.
     * @param array $options
     * @param callable|null $beforeAPICall
     * @param callable|null $afterAPICall
     * @throws ConfigurationException
     */
    public function __construct(array $options = [], callable $beforeAPICall = null, callable $afterAPICall = null)
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
        $this->beforeAPICall = $beforeAPICall;
        $this->afterAPICall = $afterAPICall;
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

    /**
     * @param $async
     * @return void
     */
    public function setAsync($async)
    {
        $this->async = $async;
    }

    /**
     * @return bool
     */
    public function getAsync()
    {
        return $this->async;
    }

    public function setPromise($promise)
    {
        $this->promises[] = $promise;
    }

    public function getPromises()
    {
        return $this->promises;
    }
    #endregion
}