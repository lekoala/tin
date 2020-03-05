<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class CZAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '000101999';
    const VALID_NUMBER2 = '000101999C';
    const INVALID_NUMBER_LENGTH = '00010199';
    const INVALID_NUMBER_DATE = '00019999';

    public function testValidNumber()
    {
        TINValid::validateTIN('cz', self::VALID_NUMBER);
        $this->assertTrue(TINValid::checkTIN('cz', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('cz', self::VALID_NUMBER2));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('cz', self::INVALID_NUMBER_LENGTH));
        $this->assertFalse(TINValid::checkTIN('cz', self::INVALID_NUMBER_DATE));
    }
}
