<?php

namespace Omnipay\BenefitGateway\Message;

use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function getData()
    {
        $this->validate(
            'currency',
            'id',
            'password',
            'resource_key',
            'amount',
            'transactionId',
            'returnUrl',
            'cancelUrl',
        );

        $data = [
            'currencycode' => $this->getCurrencyNumeric(),
            'langid' => 'USA',
            'amt' => $this->getAmount(),
            'trackid' => $this->getTransactionId(),
            'action' => 1,
            'responseUrl' => $this->getReturnUrl(),
            'errorUrl' => $this->getCancelUrl(),
            'id' => $this->getId(),
            'password' => $this->getPassword()
        ];

        $params = encryptAES(urldecode(http_build_query($data)), $this->getResourceKey());
        $data['encrypted'] = $params;

        return $data;
    }

    /**
     * Get gateway id
     *
     * @return String
     */
    public function getId()
    {
        return $this->getParameter('id');
    }
    /**
     * Get gateway password
     *
     * @return String
     */
    public function getPassword()
    {
        return $this->getParameter('password');
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
     * Set gateway id
     *
     * @param string $value
     * @return void
     */
    public function setId($value)
    {
        $this->setParameter('id', $value);
    }
    
    /**
     * Set gateway password
     *
     * @param string $value
     * @return void
     */
    public function setPassword($value)
    {
        $this->setParameter('password', $value);
    }

    /**
     * Set gateway resource key
     *
     * @param string $value
     * @return void
     */
    public function setResourceKey($value)
    {
        $this->setParameter('resource_key', $value);
    }

    /**
     * Get the payment currency number.
     *
     * @return string|null
     */
    public function getCurrencyNumeric()
    {
        if (!$this->getCurrency()) {
            return null;
        }

        return getCurrency($this->getCurrency())['code'];
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
        return $this->response = new PurchaseResponse($this, $data);
    }
}
