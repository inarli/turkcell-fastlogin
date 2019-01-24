<?php
/**
 * Turkcell FastLogin API Client
 *
 * @since     Jan 2019
 * @author    İlkay Narlı <ilkaynarli@gmail.com>
 */

namespace TurkcellFastLogin\Model;


use Psr\Http\Message\ResponseInterface;
use TurkcellFastLogin\Exception\ApiHttpException;

class Base
{
    protected function __construct()
    {
    }

    /**
     * @param ResponseInterface $response
     * @throws ApiHttpException
     */
    public static function createFromResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() !== 200) {
            throw new ApiHttpException(sprintf('Turkcell FastLogin Api Returned Exception. Code : %s', $response->getStatusCode()));
        }
    }
}
