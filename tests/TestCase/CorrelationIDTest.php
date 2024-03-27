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

use PHPUnit\Framework\TestCase;
use Phauthentic\Infrastructure\Utils\CorrelationID;

/**
 * CorrelationIdTest
 */
class CorrelationIDTest extends TestCase
{
    /**
     * @return void
     */
    public function testCorrelationId(): void
    {
        $result = CorrelationID::toString();
        $this->assertEquals(36, strlen($result));

        $result2 = CorrelationID::toString();
        $this->assertEquals($result, $result2);

        $this->assertTrue(CorrelationID::sameAs(CorrelationID::toString()));
        $this->assertFalse(CorrelationID::sameAs('1234'));
    }
}
