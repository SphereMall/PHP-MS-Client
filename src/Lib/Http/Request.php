<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:18
 */

namespace SphereMall\MS\Lib\Http;

use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Promise;
use SphereMall\MS\Client;
use SphereMall\MS\Resources\Resource as ServiceResource;

/**
 * @property Client $client
 * @property ServiceResource $resource
 */
class Request
{
    #region [Properties]
    protected $client;
    protected $resource;
    #endregion

    #region [Constructor]
    /**
     * RequestHandler constructor.
     * @param Client $client
     * @param ServiceResource $resource
     */
    public function __construct(Client $client, ServiceResource $resource)
    {
        $this->client = $client;
        $this->resource = $resource;
    }

    #endregion

    #region [Public methods]
    /**
     * @param string $method
     * @param bool $body
     * @param bool $uriAppend
     * @param array $queryParams
     * @return Promise\PromiseInterface|Response
     */
    public function handle(string $method, $body = false, $uriAppend = false, array $queryParams = [])
    {
        $client = new \GuzzleHttp\Client();

        //Set user authorization
        //$options = $this->setAuthorization();
        $options = [];

        //Generate request URL
        $url = $this->client->getGatewayUrl() . '/' .
            $this->resource->getVersion() . '/' .
            $this->resource->getURI();

        //Base url should end without slash
        $url = str_replace('?', '', $url);
        $url = rtrim($url, '/');

        //Append additional data to url
        if ($uriAppend) {
            $url = $url . '/' . $uriAppend;
        }

        //Add query params
        if ($queryParams) {
            $url = $url . '?' . http_build_query($queryParams);
        }

        if ($body) {
            switch (strtolower($method)) {
                case 'put':
                    $options['body'] = http_build_query($body);
                    break;

                case 'post':
                    $options['content-type'] = 'application/x-www-form-urlencoded';
                    $options['form_params'] = $body;
                    break;

                case 'delete':
                    $options['body'] = http_build_query($body);
                    break;

            }
        }
        //Set statistic history for current call
        $this->client->setCallStatistic(compact('method', 'url', 'options'));

        //Check and generate async request if needed
        $async = $this->client->getAsync();
        if ($async) {
            return compact('method', 'url', 'options');
        }

        //Call closure if existing
        if ($this->client->beforeAPICall) {
            call_user_func($this->client->beforeAPICall, $method, $url, $options);
        }

        //Return response
        return new Response($client->request($method, $url, $options));
    }
    #endregion

    #region [Private methods]
    private function setAuthorization()
    {
        $token = null;

        $options['content-type'] = 'application/x-www-form-urlencoded';
        $options['form_params']['client_id'] = $this->client->getClientId();
        $options['form_params']['client_secret'] = $this->client->getSecretKey();

        $options['headers']['User-Agent'] = $_SERVER['SERVER_NAME'] . '_AGENT_' . Client::$userAgent;


        //Generate request URL
        $url = $this->client->getGatewayUrl() . '/' .
            $this->client->getVersion() . '/' .
            '/oauth/token';

        try {
            $client = new \GuzzleHttp\Client();
            $response = new Response($client->request('POST', $url, $options));
            if ($response->getSuccess()) {
                $token = $response->getData()[0]['token'] ?? false;
            }

        } catch (TransferException $e) {
            return false;
        }

        return [
            'headers' => [
                'Authorization' => "Bearer $token",
                'User-Agent'    => $options['headers']['User-Agent'],
            ],
        ];
    }
    #endregion
}