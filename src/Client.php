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
use SphereMall\MS\Lib\Http\Response;
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
 * @property int $amountOfCalls
 * @property array $responseHistory
 */
class Client
{
    use ServiceInjector;

    #region [Properties]
    public        $beforeAPICall;
    public        $afterAPICall;
    public static $userAgent = "SM_SDK_PHP_CLIENT";

    protected $gatewayUrl;
    protected $clientId;
    protected $secretKey;
    protected $version = 'v1';
    protected $services;
    protected $calledService;

    protected $amountOfCalls   = 0;
    protected $responseHistory = [];

    protected $async    = false;
    protected $promises = [];
    #endregion

    #region [Constructor]
    /**
     * Client constructor.
     *
     * @param array $options
     * @param callable|null $beforeAPICall
     * @param callable|null $afterAPICall
     *
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
        $this->afterAPICall  = $afterAPICall;
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
     *
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

    /**
     * Set call statistic
     *
     * @param $callData
     */
    public function setCallStatistic($callData)
    {
        $this->amountOfCalls++;
        $this->responseHistory[] = $callData;
    }

    public function getCallsStatistic()
    {
        return [
            'amount'  => $this->amountOfCalls,
            'history' => $this->responseHistory,
        ];
    }
    #endregion

    #region [Setters methods]
    /**
     * @param string $secretKey
     *
     * @return $this
     */
    public function setSecretKey(string $secretKey)
    {
        $this->secretKey = $secretKey;

        return $this;
    }

    /**
     * @param string $clientId
     *
     * @return $this
     */
    public function setClientId(string $clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @param string $gatewayUrl
     *
     * @return $this
     */
    public function setGateWayUrl(string $gatewayUrl)
    {
        $this->gatewayUrl = $gatewayUrl;

        return $this;
    }

    /**
     * @param $version
     *
     * @return Client
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }
    #endregion

    #region [Override methods]
    public function __clone()
    {
        static::$basket = null;
    }
    #endregion
}
