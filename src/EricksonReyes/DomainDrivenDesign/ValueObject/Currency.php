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
    public const ERROR_INVALID_CURRENCY_CODE = 'Currency code must consist of three letters.';
    public const ERROR_NON_ALPHABETICAL_CURRENCY_CODE = 'Currency code must consist of letters.';

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
            throw new InvalidCurrencyCodeException(self::ERROR_NON_ALPHABETICAL_CURRENCY_CODE);
        }

        if ($codeLength !== self::STANDARD_CURRENCY_CODE_LENGTH) {
            throw new InvalidCurrencyCodeException(self::ERROR_INVALID_CURRENCY_CODE);
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
