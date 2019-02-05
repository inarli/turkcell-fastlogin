<?php
/**
 * Turkcell FastLogin API Client
 *
 * @since     Jan 2019
 * @author    İlkay Narlı <ilkaynarli@gmail.com>
 */
namespace TurkcellFastLogin\Model;

class Error
{
    /**
     * @var string
     */
    private $error;

    /**
     * @var string
     */
    private $errorDescription;

    /**
     * @var string
     */
    private $rawResponse;

    /**
     * Error constructor.
     *
     * @param string $errorContent
     */
    public function __construct($errorContent)
    {
        $this->errorParser($errorContent);
    }

    /**
     * @param $errorContent
     *
     * @return array
     */
    private function errorParser($errorContent) {
        $errorContentArr = json_decode($errorContent, true);
        if ($errorContentArr === null && json_last_error() !== JSON_ERROR_NONE){
            $this->setError($error);
            $this->setRawResponse($errorContent);
        }
        $error = !empty($errorContentArr['error']) ? $errorContentArr['error'] : null;
        $errorDescription = !empty($errorContentArr['error_description']) ? $errorContentArr['error_description'] : null;
        $this->setError($error);
        $this->setErrorDescription($errorDescription);
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     *
     * @return Error
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorDescription()
    {
        return $this->errorDescription;
    }

    /**
     * @param mixed $errorDescription
     *
     * @return Error
     */
    public function setErrorDescription($errorDescription)
    {
        $this->errorDescription = $errorDescription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    /**
     * @param mixed $rawResponse
     *
     * @return Error
     */
    public function setRawResponse($rawResponse)
    {
        $this->rawResponse = $rawResponse;
        return $this;
    }

    /**
     * @return string
     */
    public function getExceptionMessage() {
        $message = 'Error : '.$this->getError().' Message : '.$this->getErrorDescription();
        if ($this->getRawResponse() !== null){
            $message .= ' Raw Response : '.$this->getRawResponse();
        }
        return $message;
    }

}
