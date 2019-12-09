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

namespace Phauthentic\Infrastructure\Utils;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CorrelationID
{
    /**
     * @var string The correlation ID.
     */
    protected static $uuid;

    /**
     * Turns this object into an UUID string.
     *
     * @return string
     * @throws \Exception
     */
    public static function toString(): string
    {
        if (empty(static::$uuid)) {
            static::$uuid = static::generate()->toString();
        }

        return static::$uuid;
    }

    /**
     * Compares the current id against another
     *
     * @param string $otherID Other ID
     * @return boolean
     */
    public static function sameAs(string $otherID): bool
    {
        return static::$uuid === $otherID;
    }

    /**
     * Generates a new correlation ID.
     *
     * @return \Ramsey\Uuid\UuidInterface
     * @throws \Exception
     */
    protected static function generate(): UuidInterface
    {
        return Uuid::uuid4();
    }

    /**
     * Constructor.
     *
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
