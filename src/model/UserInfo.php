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
 * Class UserInfo
 *
 * @package TurkcellFastLogin\Model
 */
class UserInfo
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
     * @throws \Exception
     */
    public function __construct (ResponseInterface $response)
    {
        if ($response->getStatusCode() !== 200) {
            throw new \Exception();
        }

        $contents = $response->getBody()->getContents();
        $userInfo = json_decode($contents);

        $this->setSub($userInfo['sub']);
        $this->setUpdatedAt($userInfo['updated_at']);
        if (!empty($userInfo['phone_number'])){
            $this->setPhoneNumber($userInfo['phone_number']);
        }
        if (!empty($userInfo['phone_number_verified'])){
            $this->setPhoneNumberVerified($userInfo['phone_number_verified']);
        }
        if (!empty($userInfo['name'])){
            $this->setName($userInfo['name']);
        }
        if (!empty($userInfo['family_name'])) {
            $this->setFamilyName($userInfo['family_name']);
        }
        if (!empty($userInfo['email'])) {
            $this->setEmail($userInfo['email']);
        }
        if (!empty($userInfo['email_verified'])) {
            $this->setEmailVerified($userInfo['email_verified']);
        }
    }

    /**
     * @return mixed
     */
    public function getSub ()
    {
        return $this->sub;
    }

    /**
     * @param mixed $sub
     *
     * @return UserInfo
     */
    public function setSub ($sub)
    {
        $this->sub = $sub;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt ()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     *
     * @return UserInfo
     */
    public function setUpdatedAt ($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber ()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     *
     * @return UserInfo
     */
    public function setPhoneNumber ($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumberVerified ()
    {
        return $this->phoneNumberVerified;
    }

    /**
     * @param mixed $phoneNumberVerified
     *
     * @return UserInfo
     */
    public function setPhoneNumberVerified ($phoneNumberVerified)
    {
        $this->phoneNumberVerified = $phoneNumberVerified;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return UserInfo
     */
    public function setName ($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFamilyName ()
    {
        return $this->familyName;
    }

    /**
     * @param mixed $familyName
     *
     * @return UserInfo
     */
    public function setFamilyName ($familyName)
    {
        $this->familyName = $familyName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail ()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return UserInfo
     */
    public function setEmail ($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailVerified ()
    {
        return $this->emailVerified;
    }

    /**
     * @param mixed $emailVerified
     *
     * @return UserInfo
     */
    public function setEmailVerified ($emailVerified)
    {
        $this->emailVerified = $emailVerified;
        return $this;
    }

}
