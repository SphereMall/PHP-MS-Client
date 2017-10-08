<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 22:32
 */

namespace SphereMall\MS;

class Response
{
    public $contents;
    /**
     * Response constructor.
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        $bodyContent = $response->getBody()->getContents();
        $this->contents = json_decode($bodyContent, true);
    }
}