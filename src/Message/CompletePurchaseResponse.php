<?php

namespace Omnipay\BenefitGateway\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        $data = $this->getData();

        if (isset($data['decrypted']) && isset($data['decrypted']['result']) && $data['decrypted']['result'] === 'CAPTURED') {
            return true;
        }

        return false;
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        return null;
    }

    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        $data = $this->getData();
        return isset($data['descrypted']['result']) ? $data['descrypted']['result'] : $data['ErrorText'];
    }

    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference()
    {
        return $this->getData()['paymentid'] ?: null;
    }

    /**
     * Get the transaction ID as generated by the merchant website.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->getData()['trackid'] ?: null;
    }
}
