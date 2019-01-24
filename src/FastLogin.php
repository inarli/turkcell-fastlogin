<?php
/**
 * Turkcell FastLogin API Client
 *
 * @since     Jan 2019
 * @author    İlkay Narlı <ilkaynarli@gmail.com>
 */

namespace TurkcellFastLogin;

use TurkcellFastLogin\Exception\TokenException;
use TurkcellFastLogin\Exception\UserInfoException;
use TurkcellFastLogin\Model\Auth;
use TurkcellFastLogin\Model\UserInfo;

/**
 * Class FastLogin
 *
 * @package TurkcellFastLogin
 */
class FastLogin extends Client {

    /**
     * @param $code
     * @param $clientId
     * @param $clientSecret
     * @param $redirectUrl
     *
     * @return \TurkcellFastLogin\Model\Auth
     * @throws \GuzzleHttp\Exception\GuzzleException
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
                'Authorizationcode' => $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => urlencode($redirectUrl)
            ]
        ];
        try {
            $response = $this->client->request('POST','/oauth/token', $options);
        } catch (\Exception $e) {
            throw new TokenException('An error occurred while get token', 500, $e);
        }
        return new Auth($response);
    }

    /**
     * @param $accessToken
     *
     * @return \TurkcellFastLogin\Model\UserInfo
     * @throws \GuzzleHttp\Exception\GuzzleException
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
            $response = $this->client->request('GET', '/userinfo', $options);
        } catch (\Exception $e){
            throw new UserInfoException('An error occurred while get token', 500, $e);
        }

        return new UserInfo($response);
    }
}
