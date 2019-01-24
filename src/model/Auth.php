<?php
/**
 * Turkcell FastLogin API Client
 *
 * @since     Jan 2019
 * @author    İlkay Narlı <ilkaynarli@gmail.com>
 */
namespace TurkcellFastLogin\Model;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Auth
 *
 * @package TurkcellFastLogin\Model
 */
class Auth extends Base
{
    /**
     * OAuth 2.0 access_token, used to get the UserInfo object
     * from the UserInfo end-point and can be reused for accessing
     * other protected resources, if required
     *
     * @var string
     */
    private $accessToken;
    /**
     * The type of token received. In Fast Login case, it should always be "Bearer"
     * @var string
     */
    private $tokenType;
    /**
     * Expiration time in seconds from the time of generation of the response
     * @var string
     */
    private $expiresnIn;
    /**
     *
     * @var string
     */
    private $scope;
    /**
     * Additional token used in OIDC to provide the Identity token claim.
     * A Base64URL encoded String, when decoded contains all the claims in JSON format
     *
     * @var string
     */
    private $idToken;

    /**
     * Auth constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @throws \Exception
     */
    public function __construct (ResponseInterface $response)
    {
        parent::__construct($response);

        $contents = $response->getBody()->getContents();
        $tokenData = json_decode($contents, true);
        $this->setAccessToken($tokenData['access_token']);
        $this->setTokenType($tokenData['token_type']);
        $this->setExpiresnIn($tokenData['expires_in']);
        $this->setScope($tokenData['scope']);
        $this->setIdToken($tokenData['id_token']);
    }

    /**
     * @return mixed
     */
    public function getAccessToken ()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     *
     * @return Auth
     */
    public function setAccessToken ($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTokenType ()
    {
        return $this->tokenType;
    }

    /**
     * @param mixed $tokenType
     *
     * @return Auth
     */
    public function setTokenType ($tokenType)
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpiresnIn ()
    {
        return $this->expiresnIn;
    }

    /**
     * @param mixed $expiresnIn
     *
     * @return Auth
     */
    public function setExpiresnIn ($expiresnIn)
    {
        $this->expiresnIn = $expiresnIn;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScope ()
    {
        return $this->scope;
    }

    /**
     * @param mixed $scope
     *
     * @return Auth
     */
    public function setScope ($scope)
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdToken ()
    {
        return $this->idToken;
    }

    /**
     * @param mixed $idToken
     *
     * @return Auth
     */
    public function setIdToken ($idToken)
    {
        $this->idToken = $idToken;
        return $this;
    }


}
