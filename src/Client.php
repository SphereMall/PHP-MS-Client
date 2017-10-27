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
}