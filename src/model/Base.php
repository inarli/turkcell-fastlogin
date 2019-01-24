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
    public function __construct (ResponseInterface $response)
    {
        if ($response->getStatusCode() !== 200) {
            throw new ApiHttpException(sprintf('Turkcell FastLogin Api Returned Exception. Code : %s', $response->getStatusCode()));
        }
    }
}
