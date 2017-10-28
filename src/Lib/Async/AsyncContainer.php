<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 27.10.2017
 * Time: 21:26
 */

namespace SphereMall\MS\Lib\Async;

use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use SphereMall\MS\Client;
use SphereMall\MS\Lib\Http\Response;

/**
 * Class AsyncContainer
 * @package SphereMall\MS\Lib\Async
 * @property array $responses
 * @property Client $client
 */
class AsyncContainer
{
    #region [Properties]
    protected $responses = [];
    protected $client;
    #endregion

    #region [Constructor]
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    #endregion

    #region [Public methods]
    /**
     * @param string $name
     * @param callable $function
     */
    public function setCall(string $name, callable $function)
    {
        $this->client->setAsync(true);
        $this->responses[$name] = $function($this->client);
    }

    /**
     * @return array
     */
    public function call()
    {
        $result = [];

        $returns = $this->responses;
        $asyncKeys = [];
        foreach ($returns as $key => $return) {
            $asyncKeys[] = $key;

            if ($this->client->beforeAPICall) {
                call_user_func($this->client->beforeAPICall,
                    $return['response']['method'],
                    $return['response']['url'],
                    $return['response']['options']);
            }
        }

        $requests = function () use ($returns) {
            foreach ($returns as $key => $return) {
                yield new Request($return['response']['method'],
                    $return['response']['url'],
                    $return['response']['options']);
            }
        };

        $pool = new Pool(new \GuzzleHttp\Client(), $requests(), [
            'concurrency' => 5,
            'fulfilled'   => function (\GuzzleHttp\Psr7\Response $guzzleResponse, $index)
            use ($returns, $asyncKeys, &$result) {
                $key = $asyncKeys[$index];
                if ($returns[$key]) {
                    $return = $returns[$key];

                    $response = new Response($guzzleResponse);
                    if ($this->client->afterAPICall) {
                        call_user_func($this->client->afterAPICall, $response);
                    }

                    $this->client->setCallStatistic($response);

                    $result[$key] = $return['maker']->make($response);

                }
            },
            'rejected'    => function ($reason, $index) {
            },
        ]);
        $promise = $pool->promise();
        $promise->wait();

        $this->client->setAsync(false);
        return $result;
    }
    #endregion
}