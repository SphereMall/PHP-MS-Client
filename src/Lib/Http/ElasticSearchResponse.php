<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 19.02.2018
 * Time: 11:31
 */

namespace SphereMall\MS\Lib\Http;

/**
 * Class ElasticSearchResponse
 * @package SphereMall\MS\Lib\Http
 * @property int $statusCode
 * @property array $headers
 * @property array $data
 * @property bool $success
 * @property string $version
 * @property array $errors
 * @property Meta $meta
 * @property array $included
 */
class ElasticSearchResponse extends Response
{
    private $multi = false;
    #region [Constructor]

    /**
     * ElasticSearchResponse constructor.
     * @param array $response
     * @param bool $multi
     * @param int $from
     * @param int $size
     * @throws \Exception
     */
    public function __construct(array $response, $multi = false, $size = 0, $from = 0)
    {
        $this->multi = $multi;

        $responses = null;
        if ($this->multi) {
            $responses = $response['responses'];
            $response = $responses[0];
        }

        $this->statusCode = (!$response['timed_out'] ? 200 : 404);
        $this->headers = [];

        try {
            $this->data = $responses ?? $response;
            $this->status = !$response['timed_out'] ? 'OK' : 'ERROR';
            $this->errors = $response['error'] ?? null;
            $this->debug = $contents['debug'] ?? null;
            $this->version = 1;
            $this->included = [];
            $this->meta = new Meta($this->data['hits']['total'] ?? 0, $size, $from);
        } catch (\Exception $ex) {
            $this->success = false;
            $this->errors = $ex->getMessage();
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * @return bool
     */
    public function getMulti()
    {
        return $this->multi;
    }
    #endregion
}
