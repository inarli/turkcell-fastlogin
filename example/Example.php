<?php
/**
 * Turkcell FastLogin API Client
 *
 * @since     Jan 2019
 * @author    İlkay Narlı <ilkaynarli@gmail.com>
 */

require_once 'vendor/autoload.php';
$client = new \TurkcellFastLogin\FastLogin($options);
$token = $client->getToken('abc','def','ghi', 'redirect');
$userInfo = $client->getUserInfo($token->getAccessToken());

var_dump($userInfo);
var_dump($token);
