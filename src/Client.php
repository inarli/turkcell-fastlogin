<?php
/**
 * Turkcell FastLogin API Client
 *
 * @since     Jan 2019
 * @author    İlkay Narlı <ilkaynarli@gmail.com>
 */
namespace TurkcellFastLogin;

/**
 * Class Client
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
            'base_uri'  => 'https://mobcon.turkcell.com.tr/mobileconnect'
        ];
        if (!empty($options)) {
            $clientOptions = array_merge($clientOptions, $options);
        }
        $this->client = new \GuzzleHttp\Client($clientOptions);
    }
}
