<?php

/**
 * Copyright (c) Florian Krämer (https://florian-kraemer.net)
 * Licensed under The GPL3 License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Florian Krämer (https://florian-kraemer.net)
 * @author    Florian Krämer
 * @link      https://github.com/Phauthentic
 * @license   https://opensource.org/licenses/MIT MIT License
 */

declare(strict_types=1);

namespace Phauthentic\Infrastructure\Test\TestCase;

use Phauthentic\Infrastructure\Utils\CorrelationID;
use PHPUnit\Framework\TestCase;
use Phauthentic\Infrastructure\Http\Middleware\CorrelationIDMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Correlation Id Middleware Test
 */
class CorrelationIDMiddlewareTest extends TestCase
{
    /**
     * @return void
     */
    public function testMiddleware(): void
    {
        $correlationId = CorrelationID::toString();

        $request = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();

        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
            ->getMock();

        $request->expects($this->once())
            ->method('withAttribute')
            ->with('CorrelationID', $correlationId)
            ->willReturnSelf();

        $request->expects($this->once())
            ->method('withHeader')
            ->with('CorrelationID', $correlationId)
            ->willReturnSelf();

        $middleware = new CorrelationIDMiddleware(CorrelationID::toString());
        $middleware->process($request, $handler);
    }
}
