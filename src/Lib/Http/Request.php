<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:18
 */

namespace SphereMall\MS\Lib\Http;

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

        $url = $this->client->getGatewayUrl() . '/' .
            $this->client->getVersion() . '/' .
            $this->resource->getURI();

        //base url should end without slash
        $url = str_replace('?', '', $url);
        $url = rtrim($url, '/');

        if ($uriAppend) {
            $url = $url . '/' . $uriAppend;
        }

        if ($queryParams) {
            $url = $url . '?' . http_build_query($queryParams);
        }

        $options = [];
        if ($body) {
            $options['content-type'] = 'application/x-www-form-urlencoded';
            $options['form_params'] = $body;
        }

        $async = $this->client->getAsync();
        if ($async) {
            return compact('method', 'url', 'options');
        }

        return new Response($client->request($method, $url, $options));
    }
    #endregion
}