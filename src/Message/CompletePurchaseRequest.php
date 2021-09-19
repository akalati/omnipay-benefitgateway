<?php

namespace Omnipay\BenefitGateway\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;

class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function getData()
    {
        $data = $this->getRequestData();

        if (isset($data['trandata'])) {
            parse_str(decryptAES($data['trandata'], $this->getResourceKey()), $decrypted);

            $this->setRequestData($decrypted);
        }

        $this->validateRequestData(
            'paymentid',
            'trackid'
        );
        return $this->getRequestData();
    }

    /**
     * Get gateway resource key
     *
     * @return String
     */
    public function getResourceKey()
    {
        return $this->getParameter('resource_key');
    }

    /**
     * Get the post data from parameters or directly from the http request
     *
     * @return Array
     */
    public function getRequestData()
    {
        return $this->getParameter('request_data') ?? $this->httpRequest->request->all();
    }

    /**
     * Set gateway resource key
     *
     * @param String $value
     * @return void
     */
    public function setResourceKey($value)
    {
        $this->setParameter('resource_key', $value);
    }

    /**
     * Set request data
     *
     * @param String $value
     * @return void
     */
    public function setRequestData($value)
    {
        $this->setParameter('request_data', $value);
    }

    /**
     * Validate request data
     */
    public function validateRequestData(...$args)
    {
        foreach ($args as $key) {
            $value = $this->getRequestData()[$key] ?? null;
            if (!isset($value)) {
                throw new InvalidRequestException("The $key parameter is required");
            }
        }
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
