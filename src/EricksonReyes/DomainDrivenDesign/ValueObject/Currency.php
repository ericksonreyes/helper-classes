<?php

namespace EricksonReyes\DomainDrivenDesign\ValueObject;

use EricksonReyes\DomainDrivenDesign\ValueObject\Exceptions\InvalidCurrencyCodeException;

/**
 * Class Currency
 * @package EricksonReyes\DomainDrivenDesign\ValueObject
 */
class Currency
{
    public const STANDARD_CURRENCY_CODE_LENGTH = 3;
    public const ERROR_NON_ALPHABETICAL_CURRENCY_CODE = 'Currency code must consist of three letters.';
    public const ERROR_SHORT_CURRENCY_CODE = 'Currency code must consist of three letters.';
    public const ERROR_INVALID_CURRENCY_CODE = 'Invalid currency code.';

    /**
     * @var string
     */
    private $code;

    public function __construct(string $code)
    {
        $trimmedCode = trim($code);
        $spacelessCode = str_replace(' ', '', $trimmedCode);
        $upperCasedCode = strtoupper($spacelessCode);
        $codeLength = strlen($upperCasedCode);

        if ((ctype_alpha($upperCasedCode) === false)) {
            throw new InvalidCurrencyCodeException(Currency::ERROR_NON_ALPHABETICAL_CURRENCY_CODE);
        }

        if ($codeLength !== Currency::STANDARD_CURRENCY_CODE_LENGTH) {
            throw new InvalidCurrencyCodeException(Currency::ERROR_SHORT_CURRENCY_CODE);
        }

        if (CurrencyCodes::doesNotHave($upperCasedCode)) {
            throw new InvalidCurrencyCodeException(Currency::ERROR_INVALID_CURRENCY_CODE .
                ' ' . $upperCasedCode);
        }

        $this->code = $upperCasedCode;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @param Currency $anotherCurrency
     * @return bool
     */
    public function matches(Currency $anotherCurrency): bool
    {
        return $this->code() === $anotherCurrency->code();
    }

    /**
     * @param Currency $anotherCurrency
     * @return bool
     */
    public function doesNotMatch(Currency $anotherCurrency): bool
    {
        return !$this->matches($anotherCurrency);
    }

}
