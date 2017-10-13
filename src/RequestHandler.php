<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:18
 */

namespace SphereMall\MS;


use SphereMall\MS\Resources\Resource;

class RequestHandler
{
    #region [Properties]
    /**
     * @var Client
     */
    private $client;
    /**
     * @var Resource
     */
    private $resource;
    #endregion

    #region [Constructor]
    /**
     * RequestHandler constructor.
     * @param Client $client
     * @param Resource $resource
     */
    public function __construct(Client $client, Resource $resource)
    {

        $this->client = $client;
        $this->resource = $resource;
    }
    #endregion

    public function handle(string $method, array $queryParams = [])
    {
        $client = new \GuzzleHttp\Client();

        $url = $this->client->getGatewayUrl() . '/' .
            $this->client->getVersion() . '/' .
            $this->resource->getURI();

        //base url should end without slash
        $url = rtrim($url, '/');
        $url = str_replace('/?', '?', $url);

        if($queryParams) {
            $url.= '?' . http_build_query($queryParams);
        }

        return new Response($client->request($method, $url));
    }
}