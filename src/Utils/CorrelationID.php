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

namespace Phauthentic\Infrastructure\Utils;

use Ramsey\Uuid\Uuid;

class CorrelationID implements CorrelationIDInterface
{
    /**
     * @var string The correlation ID.
     */
    protected static string $value;

    /**
     * Generates a new UUIDv4.
     *
     * @return string
     * @throws \Random\RandomException;
     */
    protected static function generate(): string
    {
        if (class_alias('Ramsey\Uuid\Uuid', 'Uuid')) {
            /** @phpstan-ignore-next-line */
            return Uuid::uuid4()->toString();
        }

        $data = random_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Turns this object into an UUID string.
     *
     * @return string
     * @throws \Exception
     */
    public static function toString(): string
    {
        if (empty(static::$value)) {
            static::$value = static::generate();
        }

        return static::$value;
    }

    /**
     * Compares the current id against another
     *
     * @param string $otherID Other ID
     * @return boolean
     */
    public static function sameAs(string $otherID): bool
    {
        return static::$value === $otherID;
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
