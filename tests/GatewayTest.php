<?php

namespace Omnipay\BenefitGateway;

use Omnipay\Tests\TestCase;

class GatewayTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->initialize([
            'testMode' => false,
            'id' => 'id',
            'password' => 'password',
            'resource_key' => 'key'
        ]);

        $this->options = [
            'amount' => 10,
            'transactionId' => 1,
            'returnUrl' => 'https://test.dev/return',
            'cancelUrl' => 'https://test.dev/cancel'
        ];
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getMessage());
        $this->assertContains('https://www.benefit-gateway.bh/payment/PaymentHTTP.htm?param=paymentInit', $response->getRedirectUrl());
        $this->assertSame('GET', $response->getRedirectMethod());
        $this->assertEquals(array(), $response->getRedirectData());
    }

    public function testCompletePurchase()
    {
        $response = $this->gateway->completePurchase([
            'request_data' => [
                "paymentid" => "121212",
                "trackid" => "1",
                "amt" => "10",
                'ErrorText' => null,
                "trandata" => "d5aeca5d58d39d62ca94184006b61d44172779547779da427e53e324957a8c4db73463c5c905f1c70e81cd15223a876afd3e63adaac383d3a4f091a021b5df29c5baaddeb00b7272bfdf236a078e6a728ad069aa8297685015746bae41ec98b7edbec61cf6de469f364a8760db44ad937714dc6b7839955220f456e55fd5a0dcd1799febe4bd3bb1eff35c7f4c9e2f47670240acfafa6fa2519ceae4263d92a3904726512bcf2498c0c4fe01c2c2d16cbf3e7468a4617d22e45b783169ff3c4ed528eab99e1e1b2f707e4d25fb612d365428b58498d10d1a67fd0f2fb15aaaf675c6f5b446fa180b1acb6159fe15435bcb73f9915aca3e41b2dc3279673b775c4154d2edb91935cafbaebfed6102be3b"
            ]
        ])->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($response->getMessage(), 'CAPTURED');
    }
}
