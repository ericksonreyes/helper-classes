<?php

namespace EricksonReyes\DomainDrivenDesign\ValueObject;

use EricksonReyes\DomainDrivenDesign\ValueObject\Exceptions\MismatchedCurrenciesException;

/**
 * Class Money
 * @package EricksonReyes\DomainDrivenDesign\ValueObject
 */
class Money
{
    public const ERROR_MISMATCHED_CURRENCIES = 'Currencies must match.';

    /**
     * @var int
     */
    private int $amount;

    /**
     * @var Currency
     */
    private Currency $currency;

    /**
     * Money constructor.
     * @param int $amount
     * @param Currency $currency
     */
    public function __construct(int $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }


    /**
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * @param Money $aMoney
     * @return bool
     */
    public function doesNotMatch(Money $aMoney): bool
    {
        return !$this->matches($aMoney);
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    protected function currencyDoesNotMatch(Money $anotherMoney): bool
    {
        return $anotherMoney->currency()->code() !== $this->currency()->code();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    protected function amountDoesNotMatch(Money $anotherMoney): bool
    {
        return $anotherMoney->amount() !== $this->amount();
    }

    /**
     * @param int $expectedAmount
     * @return bool
     */
    public function amountIsLessThan(int $expectedAmount): bool
    {
        return $this->amount() < $expectedAmount;
    }

    /**
     * @param int $expectedAmount
     * @return bool
     */
    public function amountMatches(int $expectedAmount): bool
    {
        return $this->amount() === $expectedAmount;
    }

    /**
     * @param int $expectedAmount
     * @return bool
     */
    public function amountIsGreaterThan(int $expectedAmount): bool
    {
        return $this->amount() > $expectedAmount;
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function matches(Money $anotherMoney): bool
    {
        $this->currenciesMustMatch($anotherMoney);
        return $this->amountMatches($anotherMoney->amount());
    }

    /**
     * @param Money $anotherMoney
     * @return true
     */
    public function isLessThan(Money $anotherMoney): bool
    {
        $this->currenciesMustMatch($anotherMoney);
        ;
        return $this->amount() < $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isLessThanOrEqualTo(Money $anotherMoney): bool
    {
        $this->currenciesMustMatch($anotherMoney);
        ;
        return $this->amount() <= $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isGreaterThanOrEqualTo(Money $anotherMoney): bool
    {
        $this->currenciesMustMatch($anotherMoney);
        ;
        return $this->amount() >= $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isGreaterThan(Money $anotherMoney):bool
    {
        $this->currenciesMustMatch($anotherMoney);
        ;
        return $this->amount() > $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     */
    private function currenciesMustMatch(Money $anotherMoney): void
    {
        if ($this->currency()->code() !== $anotherMoney->currency()->code()) {
            throw new MismatchedCurrenciesException(Money::ERROR_MISMATCHED_CURRENCIES);
        }
    }
}
