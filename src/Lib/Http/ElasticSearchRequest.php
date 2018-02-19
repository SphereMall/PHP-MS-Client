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
    public function handle(string $method, $body = false, $uriAppend = false, array $queryParams = [])
    {
        $clientBuilder = new ClientBuilder();
        //$url           = $this->client->getGatewayUrl() . '/' . $this->resource->getVersion() . '/' . $this->resource->getURI();
        $url    = '192.168.53.72:9200';
        $client = $clientBuilder->setConnectionParams(['client' => ['headers' => $this->setAuthorization()]])
                                ->setHosts([$url])
                                ->build();

        // ToDo: do we need exception catching here?
        /*try{
            $response = new ElasticSearchResponse($client->search($queryParams));
        } catch (\Exception $ex){
            $a = 1;
        }*/

        return new ElasticSearchResponse($client->search($queryParams));
    }
}
