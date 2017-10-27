<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 27.10.2017
 * Time: 21:26
 */

namespace SphereMall\MS\Lib\Async;

use SphereMall\MS\Client;
use GuzzleHttp\Promise;
use SphereMall\MS\Lib\Http\Response;

class AsyncContainer
{
    protected $returns = [];
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->client->setAsync(true);
    }

    public function setCall(callable $function)
    {
        $this->returns[] = $function($this->client);
    }

    public function call()
    {
        $result = [];

        foreach ($this->returns as $return) {
            $promise = Promise\settle($return['promise'])->wait();
            $result[] = $return['maker']->make(new Response($promise[0]['value']));
        }

        return $result;
    }
}