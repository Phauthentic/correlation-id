<?php

/**
 * Copyright (c) Florian Krämer (https://florian-kraemer.net)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Florian Krämer (https://florian-kraemer.net)
 * @author    Florian Krämer
 * @link      https://github.com/Phauthentic
 * @license   https://opensource.org/licenses/MIT MIT License
 */

declare(strict_types=1);

namespace Phauthentic\Infrastructure\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Correlation Id Middleware
 */
class CorrelationIDMiddleware implements MiddlewareInterface
{

    /**
     * @var string
     */
    protected $correlationID;

    /**
     * @var string
     */
    protected $attributeName = 'CorrelationID';

    /**
     * @var string
     */
    protected $headerName = 'CorrelationID';

    /**
     * Constructor
     *
     * @param string $correlationID Correlation Id
     * @param string $attributeName Attribute Name
     * @param string $headerName Header Name
     */
    public function __construct(
        string $correlationID,
        string $attributeName = 'CorrelationID',
        string $headerName = 'CorrelationID'
    ) {
        $this->correlationID = $correlationID;
        $this->attributeName = $attributeName;
        $this->headerName = $headerName;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        if (
            $request->getHeader($this->headerName) === []
            || $request->getAttribute($this->headerName, false)
        ) {
            $request = $request->withAttribute(
                $this->attributeName,
                $this->correlationID
            );

            $request = $request->withHeader(
                $this->headerName,
                $this->correlationID
            );
        }

        return $handler->handle($request);
    }
}
