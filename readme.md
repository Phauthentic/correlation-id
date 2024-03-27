# Correlation ID

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/Phauthentic/correlation-id/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/correlation-id/)
[![Code Quality](https://img.shields.io/scrutinizer/g/Phauthentic/correlation-id/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/correlation-id/)

An implementation of a Correlation ID and a framework agnostic PSR 15-HTTP middlware.

> A Correlation ID, also known as a Transit ID, is a unique identifier value that is attached to requests and messages that allow reference to a particular transaction or event chain. The Correlation Pattern, which depends on the use of Correlation ID is a well documented Enterprise Integration Pattern.

 * [The value of a correlation ID](https://blog.rapid7.com/2016/12/23/the-value-of-correlation-ids/)
 * [Identity Correlation on Wikipedia](https://en.wikipedia.org/wiki/Identity_correlation)

## Documentation

### The Correlation ID Value Object

The correlation ID is a singleton class that will always return the same ID for the current life-cycle of the request.

Calling `CorrelationID::toString()` will return a string and will return the same string for the whole live cycle of the application. You can compare a string to the Correlation ID by calling `CorrelationID::sameAs('your-string')`.

By default it uses its internal implementation to generate a UUID v4 as value of the Correlation ID. If you are using [ramsey/uuid](https://github.com/ramsey/uuid), it will use it automatically.

### PSR 15 HTTP Middleware

The middleware will automatically put the correlation ID into your request object as attribute and header value. By default both use the `CorrelationID` name.

```php
$middleware = new CorrelationIDMiddleware(
    CorrelationID::toString()
);
```

### Response

Since there is no standard for where this needs to be done, just add the correlation ID to your response where it suits your architecture or framework the best.

```php
$response->withHeader('CorrelationID', CorrelationId::toString());
```

For Symfony there is a [bundle](https://github.com/Phauthentic/correlation-id-symfony-bundle) available that will automatically make the Correlation ID available in the request and response object.

## Copyright & License

Licensed under the [MIT license](LICENSE.txt).

Copyright (c) [Phauthentic](https://github.com/Phauthentic) / Florian Krämer
