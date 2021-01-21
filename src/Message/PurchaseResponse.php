<?php

namespace Omnipay\BenefitGateway\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    private $productionEndpoint = 'https://www.benefit-gateway.bh/payment/PaymentHTTP.htm?param=paymentInit';
    private $testEndpoint = 'https://www.test.benefit-gateway.bh/payment/PaymentHTTP.htm?param=paymentInit';

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * Does the response require a redirect?
     *
     * @return boolean
     */
    public function isRedirect()
    {
        return true;
    }
    
    /**
     * Get the required redirect method (either GET or POST).
     *
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * Gets the redirect target url.
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        $data = $this->getData();

        $queryParam = '&trandata=' . $data['encrypted'] . "&errorURL=" . $data['errorUrl'] . "&responseURL=" . $data['responseUrl'] . "&tranportalId=" . $data['id'];
        if ($this->request->getTestMode()) {
            return $this->testEndpoint . $queryParam;
        }
        return $this->productionEndpoint .  $queryParam;
    }
}
