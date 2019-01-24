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
    private $expiresIn;
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
     * Auth constructor
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return Auth
     */
    public static function createFromResponse(ResponseInterface $response)
    {
        parent::createFromResponse($response);

        $object = new self();

        $contents = $response->getBody()->getContents();
        $tokenData = json_decode($contents, true);
        $object->setAccessToken($tokenData['access_token']);
        $object->setTokenType($tokenData['token_type']);
        $object->setExpiresIn($tokenData['expires_in']);
        $object->setScope($tokenData['scope']);
        $object->setIdToken($tokenData['id_token']);

        return $object;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     *
     * @return Auth
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @param string $tokenType
     *
     * @return Auth
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param mixed $expiresIn
     *
     * @return Auth
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     *
     * @return Auth
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdToken()
    {
        return $this->idToken;
    }

    /**
     * @param mixed $idToken
     *
     * @return Auth
     */
    public function setIdToken($idToken)
    {
        $this->idToken = $idToken;

        return $this;
    }
}
