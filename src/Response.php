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
    #region [Properties]
    /**
     * @var int
     */
    private $statusCode;
    /**
     * @var array
     */
    private $headers;
    /**
     * @var
     */
    private $data;
    /**
     * @var bool
     */
    private $success;
    /**
     * @var
     */
    private $version;
    /**
     * @var string
     */
    private $error;
    /**
     * @var array
     */
    private $included;
    #endregion

    #region [Constructor]
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
    #endregion

    #region [Getters]
    /**
     * @return bool
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string:array
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return array
     */
    public function getIncluded()
    {
        return $this->included;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    #endregion
}