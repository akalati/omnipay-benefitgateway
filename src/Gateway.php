<?php

namespace Omnipay\BenefitGateway;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'BenefitGateway';
    }

    /**
     * Define gateway parameters, in the following format:
     *
     * array(
     *     'currency' => 'BHD', // string variable (accepts only BHD)
     * );
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'currency' => 'BHD',
        ];
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
     * Authorize and immediately capture an amount on the customers card
     *
     * array(
     *      "amount" => 10,
     *      "transactionId" => "121",
     *      "returnUrl" => "https://",
     *      "cancelUrl" => "https://"
     *   )
     */
    public function purchase(array $options = array())
    {
        return $this->createRequest('\Omnipay\BenefitGateway\Message\PurchaseRequest', $options);
    }

    /**
     * Handle return from off-site gateways after purchase
     */
    public function completePurchase(array $options = array())
    {
        return $this->createRequest('\Omnipay\BenefitGateway\Message\CompletePurchaseRequest', $options);
    }
}
