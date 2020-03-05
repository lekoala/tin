<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Denmark
 */
class DKAlgorithm extends TINAlgorithm
{
    const LENGTH = 10;
    const PATTERN = "[0-3]\\d[0-1]\\d{3}\\d{4}";

    public function validate(string $tin)
    {
        $whithoutHyphen = str_replace("-", "", $tin);
        if (!$this->isFollowLength($whithoutHyphen)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern($whithoutHyphen) || !$this->isValidDate($whithoutHyphen)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($whithoutHyphen)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }

    public function isFollowPattern(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN);
    }

    public function isFollowRules(string $tin)
    {
        return $this->isFollowDenmarkRule($tin);
    }

    public function isFollowDenmarkRule(string $tin)
    {
        $serialNumber = intval(StringUtil::substring($tin, 6, 10));
        $yearOfBirth = intval(StringUtil::substring($tin, 4, 6));
        if ($yearOfBirth >= 37 && $yearOfBirth <= 57 && $serialNumber >= 5000 && $serialNumber <= 8999) {
            return false;
        }
        $c1 = StringUtil::digitAt($tin, 0);
        $c2 = StringUtil::digitAt($tin, 1);
        $c3 = StringUtil::digitAt($tin, 2);
        $c4 = StringUtil::digitAt($tin, 3);
        $c5 = StringUtil::digitAt($tin, 4);
        $c6 = StringUtil::digitAt($tin, 5);
        $c7 = StringUtil::digitAt($tin, 6);
        $c8 = StringUtil::digitAt($tin, 7);
        $c9 = StringUtil::digitAt($tin, 8);
        $c10 = StringUtil::digitAt($tin, 9);
        $sum = $c1 * 4 + $c2 * 3 + $c3 * 2 + $c4 * 7 + $c5 * 6 + $c6 * 5 + $c7 * 4 + $c8 * 3 + $c9 * 2;
        $remainderBy11 = $sum % 11;
        if ($remainderBy11 == 1) {
            return false;
        }
        if ($remainderBy11 == 0) {
            return $c10 == 0;
        }
        return $c10 == 11 - $remainderBy11;
    }

    private function isValidDate(string $tin)
    {
        $day = intval(StringUtil::substring($tin, 0, 2));
        $month = intval(StringUtil::substring($tin, 2, 4));
        $year = intval(StringUtil::substring($tin, 4, 6));
        return DateUtil::validate(1900 + $year, $month, $day) || DateUtil::validate(2000 + $year, $month, $day);
    }
}
