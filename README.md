# Taxpayer Identification Number (TIN) Validator

A library to validate TIN numbers. This is based on a java library,
this is why the code does not reflect best practices in php.

Supported countries are:
- Austria (AT)
- Belgium (BE)
- Bulgaria (BG)
- Croatia (HR)
- Cyprus (CY)
- Czech Republic (CZ) - no check digit
- Denmark (DK)
- Estonia (EE)
- Finland (FI)
- France (FR)
- Germany	23
- Greece (GR) - only size
- Hungary (HU)
- Ireland	(IE)
- Italy (IT)
- Latvia (LV) - no check digit
- Lithuania	(LT)
- Luxembourg (LU)
- Malta (MT) - no check digit
- Netherlands (NL)
- Poland (PL)
- Portugal (PT)
- Romania (RO) - no check digit
- Slovakia (SK) - only structure
- Slovenia (SI)
- Spain (ES)
- Sweden (SE)
- United Kingdom (UK) - only structure

## Installation

Run

```
$ composer require lekoala/tin
```

## Usage

To simply check the validity of a number

    TINValid::checkTIN($countryCode, $number)

If you want to get the reason why a number is invalid, you can use

    try {
        TINValid::validateTIN($countryCode, $number)
    }
    catch(TINValidationException $e) {
        
    }

## Links

[`TIN Algorithms - Public - Functional Specification`](https://ec.europa.eu/taxation_customs/tin/specs/FS-TIN Algorithms-Public.docx)
[`Taxpayer Identification Number`](https://en.wikipedia.org/wiki/Taxpayer_Identification_Number)

## License

This package is licensed using the MIT License.
Please have a look at [`LICENSE.md`](LICENSE.md).
