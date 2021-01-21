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
