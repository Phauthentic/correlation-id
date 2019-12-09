# Correlation ID

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/Phauthentic/correlation-id/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/correlation-id/)
[![Code Quality](https://img.shields.io/scrutinizer/g/Phauthentic/correlation-id/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/correlation-id/)

> A Correlation ID, also known as a Transit ID, is a unique identifier value that is attached to requests and messages that allow reference to a particular transaction or event chain. The Correlation Pattern, which depends on the use of Correlation ID is a well documented Enterprise Integration Pattern.

 * [The value of a correlation ID](https://blog.rapid7.com/2016/12/23/the-value-of-correlation-ids/)
 * [Identity Correlation on Wikipedia](https://en.wikipedia.org/wiki/Identity_correlation)

## Documentation

### Correlation ID

The correlation ID is a singleton class that will always return the same ID for the current life-cycle of the request.

### Middleware

The middleware will automatically put the correlation ID into your request object as attribute and header value. By default both use the `CorrelationID` name.

```
$middleware = new CorrelationIDMiddleware(
    CorrelationID::toString()
);
```

### Response

Since there is no standard for where this needs to be done, just add the correlation ID to your response where ever it suits your architecture or framework.

```php
$response->withHeader('CorrelationID', CorrelationId::toString());
```

## Copyright & License

Licensed under the [MIT license](LICENSE.txt).

Copyright (c) [Phauthentic](https://github.com/Phauthentic) / Florian Krämer
