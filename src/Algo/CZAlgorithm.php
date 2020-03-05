<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Czech Republic
 */
class CZAlgorithm extends TINAlgorithm
{
    const LENGTH_1 = 9;
    const LENGTH_2 = 10;

    public function validate(string $tin)
    {
        $str = StringUtil::clearString($tin);
        if (!$this->isFollowLength1($str) && !$this->isFollowLength2($str)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isValidDate($str)) {
            return StatusCode::INVALID_PATTERN;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength1(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_1);
    }

    public function isFollowLength2(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_2);
    }

    /**
     * @param string $tin
     * @return boolean
     */
    private function isValidDate(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 0, 2));
        $month = intval(StringUtil::substring($tin, 2, 4));
        $day = intval(StringUtil::substring($tin, 4, 6));

        $y1 = DateUtil::validate(1900 + $year, $month, $day);
        $y2 = DateUtil::validate(2000 + $year, $month, $day);
        if (!$y1 || !$y2) {
            return false;
        }
        return true;
    }
}
