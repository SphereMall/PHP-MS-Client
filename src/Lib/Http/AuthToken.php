<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/5/2017
 * Time: 12:32 PM
 */

namespace SphereMall\MS\Lib\Http;

use GuzzleHttp\Exception\TransferException;
use SphereMall\MS\Client;

/**
 * Class AuthToken
 * @package SphereMall\MS\Lib\Http
 */
class AuthToken
{
    /**
     * @var Client
     */
    private $client;

    const GUEST_COOKIE_NAME = "MS_GUEST_COOKIE";

    /**
     * AuthToken constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return array|bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function getTokenData()
    {
        $token     = null;
        $userAgent = ($_SERVER['SERVER_NAME'] ?? 'SphereMall') . '_AGENT_' . Client::$userAgent;

        if (isset($_COOKIE[AuthToken::GUEST_COOKIE_NAME])) {
            $token = $_COOKIE[AuthToken::GUEST_COOKIE_NAME];

            return [$token, $userAgent];
        }

        $options['content-type']                 = 'application/x-www-form-urlencoded';
        $options['form_params']['client_id']     = $this->client->getClientId();
        $options['form_params']['client_secret'] = $this->client->getSecretKey();
        $options['headers']['User-Agent']        = $userAgent;


        $url = $this->client->getGatewayUrl() . '/' . $this->client->getVersion() . '/' . 'oauth/token';

        try {
            $client   = new \GuzzleHttp\Client();
            $response = new Response($client->request('POST', $url, $options));
            if ($response->getSuccess()) {
                $token    = $response->getData()[0]['token'] ?? false;
                $expiries = $response->getData()[0]['expiries'];
                $isGuest  = $response->getData()[0]['isGuest'];
                if ($isGuest) {
                    try {
                        setcookie(AuthToken::GUEST_COOKIE_NAME, $token, time() + $expiries, '/');
                    } catch (\Exception $ex) {
                        //TODO: Can not set cookies with unit tests
                    }
                }
            }

        } catch (TransferException $e) {
            return false;
        }

        return [$token, $userAgent];
    }
}
