<?php
/**
 * Turkcell FastLogin API Client
 *
 * @since     Jan 2019
 * @author    İlkay Narlı <ilkaynarli@gmail.com>
 */

namespace TurkcellFastLogin;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use TurkcellFastLogin\Exception\ApiHttpException;
use TurkcellFastLogin\Exception\TokenException;
use TurkcellFastLogin\Exception\UserInfoException;
use TurkcellFastLogin\Model\Auth;
use TurkcellFastLogin\Model\UserInfo;

/**
 * Class FastLogin
 *
 * @package TurkcellFastLogin
 */
class Client
{

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Client constructor.
     *
     * @param array $options
     */
    public function __construct ($options = [])
    {
        $clientOptions = [
            'exceptions' => false,
            'timeout'   => 10.0,
            'base_uri'  => 'https://mobcon.turkcell.com.tr/'
        ];
        if (!empty($options)) {
            $clientOptions = array_merge($clientOptions, $options);
        }
        $this->client = new \GuzzleHttp\Client($clientOptions);
    }

    /**
     * @param $code
     * @param $clientId
     * @param $clientSecret
     * @param $redirectUrl
     *
     * @return \TurkcellFastLogin\Model\Auth
     * @throws \TurkcellFastLogin\Exception\TokenException
     */
    public function getToken($code, $clientId, $clientSecret, $redirectUrl) {
        $options = [
            'headers' => [
                'Authorization' => 'Basic '.base64_encode($clientId.':'.$clientSecret),
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Access-Control-Allow-Origin' => 'mobcon.turkcell.com.tr',
                'Accept' => 'text/plain, application/json, application/json, application/*+json, application/*+json, text/plain, */*, */*'
            ],
            'form_params' => [
                'code' => $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => urlencode($redirectUrl)
            ]
        ];
        try {
            $response = $this->client->request('POST', 'mobileconnect/oauth/token', $options);
        } catch (ClientException $e) {
            throw new ApiHttpException('An error occurred while getting token', $e->getCode(), $e);
        } catch (GuzzleException $e) {
            throw new TokenException('An error occurred while getting token ['.get_class($e).']', 500, $e);
        } catch (\Exception $e) {
            throw new TokenException('An error occurred while getting token', 500, $e);
        }
        return Auth::createFromResponse($response);
    }

    /**
     * @param $accessToken
     *
     * @return \TurkcellFastLogin\Model\UserInfo
     * @throws \TurkcellFastLogin\Exception\UserInfoException
     */
    public function getUserInfo($accessToken) {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ];
        try{
            $response = $this->client->request('GET', 'mobileconnect/userinfo', $options);
        } catch (ClientException $e) {
            throw new ApiHttpException('An error occurred while getting user information', $e->getCode(), $e);
        } catch (GuzzleException $e) {
            throw new UserInfoException('An error occurred while getting user information ['.get_class($e).']', 500, $e);
        } catch (\Exception $e){
            throw new UserInfoException('An error occurred while getting user information', 500, $e);
        }

        return UserInfo::createFromResponse($response);
    }
}
