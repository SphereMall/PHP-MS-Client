<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 19.11.18
 * Time: 17:10
 */

namespace SphereMall\MS\Resources\ElasticSearch;

use SphereMall\MS\Client;
use SphereMall\MS\Lib\Elastic\Builders\{BodyBuilder, FilterBuilder, Search\MSearch, Search\Search};
use SphereMall\MS\Lib\Makers\{ElasticFacetedMaker, ElasticSearchGroupByMaker, ElasticSearchMaker};
use SphereMall\MS\Lib\Helpers\ClassReflectionHelper;
use SphereMall\MS\Lib\Http\ElasticSearch\Request as ElasticSearchRequest;
use SphereMall\MS\Resources\Resource;

/**
 * Class ElasticResource
 *
 * @package SphereMall\MS\Resources\ElasticSearch
 */
class ElasticResource extends Resource
{
    private $search = null;

    /**
     * ElasticResource constructor
     *
     * @param Client $client
     * @param null   $version
     * @param null   $handler
     * @param null   $maker
     */
    public function __construct(Client $client, $version = null, $handler = null, $maker = null)
    {
        parent::__construct($client, $version, $handler, $maker);
        $this->handler = $handler ?? null;
    }

    /**
     * @return string
     */
    public function getURI()
    {
        return 'elasticindexer';
    }

    /**
     * @return string
     */
    public function getElasticUrl()
    {
        return 'elasticsearch';
    }

    /**
     * @param BodyBuilder $builder
     *
     * @return $this
     */
    public function search(BodyBuilder $builder)
    {
        $this->search = new Search($builder);

        return $this;
    }

    /**
     * @param array $builders
     *
     * @return $this
     */
    public function msearch(array $builders)
    {
        $this->search = new MSearch($builders);

        return $this;
    }

    /**
     * @param array|\SphereMall\MS\Lib\Filters\Filter|\SphereMall\MS\Lib\Specifications\Basic\FilterSpecification $filter
     *
     * @return $this|Resource
     * @throws \Exception
     */
    public function filter($filter)
    {
        if (!is_a($filter, FilterBuilder::class)) {
            throw new \Exception ("Filter must be extend class 'FilterBuilder'");
        }

        $this->filter = $filter;

        return $this;
    }

    /**
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function facets()
    {
        $handler  = new \SphereMall\MS\Lib\Http\Request($this->client, $this);
        $response = $handler->handle('GET', $this->filter->getConfigs(), 'filter', $this->filter->getQuery());

        $this->maker = new ElasticFacetedMaker();

        return $this->make($response);
    }

    /**
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all()
    {
        $handler  = new ElasticSearchRequest($this->client, $this);
        $response = $handler->handle('GET', false, false, [$this->search]);

        if (is_array($response)) {
            foreach ($response as $responseItem) {
                if ($debugInfo = $responseItem->getDebug()) {
                    $this->client->setCallStatistic([
                        'url'     => $debugInfo['response']['effective_url'] ?? '',
                        'method'  => $debugInfo['request']['http_method'] ?? '',
                        'options' => ['body' => $debugInfo['request']['body'] ?? ''],
                        'time'    => $debugInfo['response']['transfer_stats']['total_time'] ?? '',
                    ]);
                }
                $result[] = $this->make($responseItem, true, new ElasticSearchMaker());
            }

            return $result ?? [];
        }

        if ($debugInfo = $response->getDebug()) {
            $this->client->setCallStatistic([
                'url'     => $debugInfo['response']['effective_url'] ?? '',
                'method'  => $debugInfo['request']['http_method'] ?? '',
                'options' => ['body' => $debugInfo['request']['body'] ?? ''],
                'time'    => $debugInfo['response']['transfer_stats']['total_time'] ?? '',
            ]);
        }

        return $this->make($response, true, $this->search->getGroupBy() ? new ElasticSearchGroupByMaker() : new ElasticSearchMaker());
    }

    /**
     * Delete one document from elasticsearch index by id
     *
     * @param string $className
     * @param int    $id
     *
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteDocumentFromIndex(string $className, int $id): bool
    {
        $client  = (new ElasticSearchRequest($this->client, $this))->createElasticClient();

        $type = (new ClassReflectionHelper($className))->getShortLowerCaseName();

        try {
            $response = $client->delete([
                'index' => "sm-{$type}s",
                'type'  => "{$type}s",
                'id'    => $id
            ]);

            return (isset($response['result'], $response['_shards']['successful']) && $response['result'] == 'deleted' && $response['_shards']['successful']);
        } catch (\Exception $ex) {
            return false;
        }
    }
}
