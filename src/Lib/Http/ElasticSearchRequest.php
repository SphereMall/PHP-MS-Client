<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 19.02.2018
 * Time: 11:12
 */

namespace SphereMall\MS\Lib\Http;

use Elasticsearch\ClientBuilder;

/**
 * Class ElasticSearchRequest
 * @package SphereMall\MS\Lib\Http
 */
class ElasticSearchRequest extends Request
{
    /**
     * @param string $method
     * @param bool   $body
     * @param bool   $uriAppend
     * @param array  $queryParams
     * @return \GuzzleHttp\Promise\PromiseInterface|ElasticSearchResponse|Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(string $method, $body = false, $uriAppend = false, array $queryParams = [])
    {
        $clientBuilder = new ClientBuilder();
        //$url           = $this->client->getGatewayUrl() . '/' . $this->resource->getVersion() . '/' . $this->resource->getURI();
        $url    = '192.168.53.72:9200';
        $client = $clientBuilder->setConnectionParams(['client' => ['headers' => $this->setAuthorization()]])
                                ->setHosts([$url])
                                ->build();

        try {
            $response = new ElasticSearchResponse($client->search($queryParams));
        } catch (\Exception $ex) {
            $error = json_decode($ex->getMessage());
            throw new \Exception($error->error->reason);
        }

        return $response;
    }
}
