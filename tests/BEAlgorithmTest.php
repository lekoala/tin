<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class BEAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '00012511119';
    const INVALID_NUMBER_CHECK = '00012511120';
    const INVALID_NUMBER_LENGTH = '0001251112020';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('be', self::VALID_NUMBER));
        $this->markTestIncomplete('test a valid number that follows BelgiumRule2');
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('be', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('be', self::INVALID_NUMBER_LENGTH));
    }
}
