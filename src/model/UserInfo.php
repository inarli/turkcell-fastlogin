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

/**
 * Class UserInfo
 *
 * @package TurkcellFastLogin\Model
 */
class UserInfo extends Base
{
    /**
     * PCR stands for "Pseudonymous Customer Reference".
     * This is a unique identifier that Fast Login uses to reference an end user
     * @var string
     */
    private $sub;
    /**
     * Time at which the user's profile data was last updated.
     * Its represented as the number of seconds from 1970-01-01T0:0:0Z as measured in UTC until the date/time
     * @var integer
     */
    private $updatedAt;
    /**
     * If user gives consent to share
     * @var string
     */
    private $phoneNumber;
    /**
     * TRUE if the phone number is verified, FALSE otherwise
     * It is expected always TRUE if user gives consent
     * @var boolean
     */
    private $phoneNumberVerified;
    /**
     * First name and middle name if exists
     * @var string
     */
    private $name;
    /**
     * surname
     * @var string
     */
    private $familyName;
    /**
     * @var string
     */
    private $email;
    /**
     * TRUE if the email address is verified, FALSE otherwise
     * @var boolean
     */
    private $emailVerified;

    /**
     * UserInfo constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return UserInfo
     */
    public static function createFromResponse(ResponseInterface $response)
    {
        parent::createFromResponse($response);

        $contents = $response->getBody()->getContents();
        $userInfo = json_decode($contents, true);

        $object = new self();

        if (!empty($userInfo['sub'])) {
            $object->setSub($userInfo['sub']);
        }
        if (!empty($userInfo['updated_at'])) {
            $object->setUpdatedAt($userInfo['updated_at']);
        }
        if (!empty($userInfo['phone_number'])){
            $object->setPhoneNumber($userInfo['phone_number']);
        }
        if (!empty($userInfo['phone_number_verified'])){
            $object->setPhoneNumberVerified($userInfo['phone_number_verified']);
        }
        if (!empty($userInfo['name'])){
            $object->setName($userInfo['name']);
        }
        if (!empty($userInfo['family_name'])) {
            $object->setFamilyName($userInfo['family_name']);
        }
        if (!empty($userInfo['email'])) {
            $object->setEmail($userInfo['email']);
        }
        if (!empty($userInfo['email_verified'])) {
            $object->setEmailVerified($userInfo['email_verified']);
        }

        return $object;
    }

    /**
     * @return string
     */
    public function getSub()
    {
        return $this->sub;
    }

    /**
     * @param string $sub
     *
     * @return UserInfo
     */
    public function setSub($sub)
    {
        $this->sub = $sub;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     *
     * @return UserInfo
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return UserInfo
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getPhoneNumberVerified()
    {
        return $this->phoneNumberVerified;
    }

    /**
     * @param boolean $phoneNumberVerified
     *
     * @return UserInfo
     */
    public function setPhoneNumberVerified($phoneNumberVerified)
    {
        $this->phoneNumberVerified = $phoneNumberVerified;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return UserInfo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * @param string $familyName
     *
     * @return UserInfo
     */
    public function setFamilyName($familyName)
    {
        $this->familyName = $familyName;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return UserInfo
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getEmailVerified()
    {
        return $this->emailVerified;
    }

    /**
     * @param boolean $emailVerified
     *
     * @return UserInfo
     */
    public function setEmailVerified($emailVerified)
    {
        $this->emailVerified = $emailVerified;

        return $this;
    }

}
