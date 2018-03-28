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
 * @property int    $statusCode
 * @property array  $headers
 * @property array  $data
 * @property bool   $success
 * @property string $version
 * @property array  $errors
 * @property Meta   $meta
 * @property array  $included
 */
class ElasticSearchResponse extends Response
{
    #region [Constructor]
    /**
     * ElasticSearchResponse constructor.
     * @param array $response
     * @throws \Exception
     */
    public function __construct(array $response)
    {
        $this->statusCode = (!$response['timed_out'] ? 200 : 404);
        $this->headers    = [];

        try {
            $this->data     = $response;
            $this->success  = !$response['timed_out'];
            $this->errors   = $response['error'] ?? null;
            $this->version  = 1;
            $this->included = [];
            $this->meta     = null;
        } catch (\Exception $ex) {
            $this->success = false;
            $this->errors  = $ex->getMessage();
            throw new \Exception($ex->getMessage());
        }
    }
    #endregion
}
