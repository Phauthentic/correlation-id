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

interface CorrelationIDInterface
{
    /**
     * Turns this object into an UUID string.
     *
     * @return string
     * @throws \Exception
     */
    public static function toString(): string;

    /**
     * Compares the current id against another
     *
     * @param string $otherID Other ID
     * @return boolean
     */
    public static function sameAs(string $otherID): bool;
}
