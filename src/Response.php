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
    private $statusCode;
    private $headers;
    private $data;
    private $success;
    private $version;
    private $error;
    private $included;

    /**
     * Response constructor.
     * @param \GuzzleHttp\Psr7\Response $response
     * @throws \Exception
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        $this->statusCode = $response->getStatusCode();
        $this->headers = $response->getHeaders();

        $bodyContent = $response->getBody()->getContents();
        $contents = json_decode($bodyContent, true);

        try {
            $this->data = $contents['data'];
            $this->success = $contents['success'];
            $this->error = $contents['error'];
            $this->version = $contents['ver'];
            $this->included = $contents['included'];
        } catch (\Exception $ex) {
            $this->success = false;
            $this->error = $ex->getMessage();
            throw new \Exception($ex->getMessage());
        }
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function getData()
    {
        return $this->data;
    }
}