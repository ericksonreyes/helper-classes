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

        if (!in_array($upperCasedCode, $this->validCurrencyCodes())) {
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

    /**
     * @return array
     */
    private function validCurrencyCodes(): array
    {
        return [
            'AFN',
            'ALL',
            'DZD',
            'USD',
            'EUR',
            'AOA',
            'XCD',
            'ARS',
            'AMD',
            'AWG',
            'AUD',
            'AZN',
            'BSD',
            'BHD',
            'BDT',
            'BBD',
            'BYR',
            'BZD',
            'XOF',
            'BMD',
            'BTN',
            'BOB',
            'BAM',
            'BWP',
            'NOK',
            'BRL',
            'BND',
            'BGN',
            'BIF',
            'KHR',
            'XAF',
            'CAD',
            'CVE',
            'KYD',
            'CLP',
            'CNY',
            'HKD',
            'COP',
            'KMF',
            'CDF',
            'NZD',
            'CRC',
            'HRK',
            'CUP',
            'CZK',
            'DKK',
            'DJF',
            'DOP',
            'ECS',
            'EGP',
            'SVC',
            'ERN',
            'ETB',
            'FKP',
            'FJD',
            'GMD',
            'GEL',
            'GHS',
            'GIP',
            'QTQ',
            'GGP',
            'GNF',
            'GWP',
            'GYD',
            'HTG',
            'HNL',
            'HUF',
            'ISK',
            'INR',
            'IDR',
            'IRR',
            'IQD',
            'GBP',
            'ILS',
            'JMD',
            'JPY',
            'JOD',
            'KZT',
            'KES',
            'KPW',
            'KRW',
            'KWD',
            'KGS',
            'LAK',
            'LBP',
            'LSL',
            'LRD',
            'LYD',
            'CHF',
            'MKD',
            'MGF',
            'MWK',
            'MYR',
            'MVR',
            'MRO',
            'MUR',
            'MXN',
            'MDL',
            'MNT',
            'MAD',
            'MZN',
            'MMK',
            'NAD',
            'NPR',
            'ANG',
            'XPF',
            'NIO',
            'NGN',
            'OMR',
            'PKR',
            'PAB',
            'PGK',
            'PYG',
            'PEN',
            'PHP',
            'PLN',
            'QAR',
            'RON',
            'RUB',
            'RWF',
            'SHP',
            'WST',
            'STD',
            'SAR',
            'RSD',
            'SCR',
            'SLL',
            'SGD',
            'SBD',
            'SOS',
            'ZAR',
            'SSP',
            'LKR',
            'SDG',
            'SRD',
            'SZL',
            'SEK',
            'SYP',
            'TWD',
            'TJS',
            'TZS',
            'THB',
            'TOP',
            'TTD',
            'TND',
            'TRY',
            'TMT',
            'UGX',
            'UAH',
            'AED',
            'UYU',
            'UZS',
            'VUV',
            'VEF',
            'VND',
            'YER',
            'ZMW',
            'ZWD',
            'BYN',
            'CUC',
            'GTQ',
            'MGA',
            'MOP',
            'MRU',
            'STN',
            'VES'
        ];
    }
}
