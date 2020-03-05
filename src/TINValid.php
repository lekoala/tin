<?php

namespace LeKoala\Tin;

use InvalidArgumentException;
use LeKoala\Tin\Algo\TINAlgorithmInterface;
use LeKoala\Tin\Exception\TINValidationException;

/**
 * The main class to validate TIN numbers
 */
class TINValid
{
    /**
     * Check if a tin is valid
     *
     * If you need the detail about why the check failed, use validateTIN
     *
     * @param string $countryCode Alpha-2 iso code
     * @param string $tin
     * @return boolean
     */
    public static function checkTIN(string $countryCode, string $tin)
    {
        try {
            self::validateTIN($countryCode, $tin);
            return true;
        } catch (TINValidationException $ex) {
            return false;
        }
    }

    /**
     * Throw an exception if number is not valid
     *
     * @throws TINValidationException
     * @param string $countryCode Alpha-2 iso code
     * @param string $tin
     * @return void
     */
    public static function validateTIN(string $countryCode, string $tin)
    {
        $inst = self::getAlgoForCountry($countryCode);
        $statusCode = $inst->isValid($tin);

        if ($statusCode !== 0) {
            $message = self::getMessageForStatusCode($statusCode);
            throw new TINValidationException($message, $statusCode);
        }
    }

    /**
     * @param integer $statusCode
     * @return string
     */
    protected static function getMessageForStatusCode($statusCode)
    {
        switch ($statusCode) {
            case 0:
                return "Valid";
            case -1:
                return "No Information";
            case 2:
                return "No Syntax Checker";
            case 1:
                return "Invalid Syntax";
            case 4:
                return "Invalid Length";
            case 3:
                return "Invalid Pattern";
            default:
                return "Default";
        }
    }

    /**
     * @param string $countryCode
     * @return TINAlgorithmInterface
     */
    protected static function getAlgoForCountry(string $countryCode)
    {
        if (strlen($countryCode) != 2) {
            throw new InvalidArgumentException("Country code should be 2 chars long.");
        }
        $class = "LeKoala\\Tin\\Algo\\" . strtoupper($countryCode) . "Algorithm";
        if (!class_exists($class)) {
            throw new InvalidArgumentException("Algorithm '$class' was not found.");
        }
        return new $class;
    }
}
