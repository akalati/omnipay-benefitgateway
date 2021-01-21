# Omnipay: Benefit gateway
**Benefit gateway driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Benefit gateway support for Omnipay.

## Installation

Omnipay is installed via [Composer](https://getcomposer.org/).
For most uses, you will need to require `league/omnipay` and an individual gateway:

```
composer require league/omnipay:^3 akalati/omanipay-benefitgateway
```

If you want to use your own HTTP Client instead of Guzzle (which is the default for `league/omnipay`),
you can require `league/common` and any `php-http/client-implementation` (see [PHP Http](http://docs.php-http.org/en/latest/clients.html))

```
composer require league/common:^3 akalati/omanipay-benefitgateway php-http/buzz-adapter
```

## Basic Usage

The following methods are provided by this package:

+ purchase
+ completePurchase

### purchase
Use purchase request to construct the redirect link and redirect the customer to benefit gateway payment page

```php
$gateway = Omnipay::create('BenefitGateway');

$gateway->setTestMode(true); //call setTestMode(true) to use benefit gateway test endpoint https://www.test.benefit-gateway.bh/payment/PaymentHTTP.htm?param=paymentInit
$gateway->setId(""); //Tranportal ID
$gateway->setPassword(""); // Tranportal Password
$gateway->setResourceKey(""); // Terminal Resourcekey

$response = $gateway->purchase([
	'amount' => 20.5, //Amount in BHD
	'transactionId' => 1, //Order or transaction reference from your system
	'returnUrl' => "https://www.example.com/return", //return url
	'cancelUrl' => "https://www.example.com/error" //error and cancel url
])->send();

$response->redirect();
```

### completePurchase
use completePurchase in your return callback to handle the request sent by the gateway to your system
```php
$gateway = Omnipay::create('BenefitGateway');

$gateway->setResourceKey(""); // Terminal Resourcekey

$response = $gateway->completePurchase()->send();

if ($response->isSuccessful()) {
	$transactionId = $response->getTransactionId(); //transaction id set in the purchase request
	$transactionReference = $response->getTransactionReference(); //transaction reference set by the gateway
	$responseData = $response->getData(); //response received from benefit gateway
	// mark order as complete
} else {
	$response->getMessage();
	// display error message to customer
}
```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.


## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/akalati/omnipay-benefitgateway/issues),
or better yet, fork the library and submit a pull request.
