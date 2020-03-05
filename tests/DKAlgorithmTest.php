<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class DKAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '010111-1113';
    const INVALID_NUMBER_CHECK = '010111-1114';
    const INVALID_NUMBER_LENGTH = '010111-11132';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('dk', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('dk', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('dk', self::INVALID_NUMBER_LENGTH));
    }
}
