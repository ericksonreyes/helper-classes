<?php

namespace EricksonReyes\DomainDrivenDesign\ValueObject;

/**
 * Class Money
 * @package EricksonReyes\DomainDrivenDesign\ValueObject
 */
class Money
{

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
    public function matches(Money $aMoney): bool
    {
        if ($this->currencyDoesNotMatch($aMoney)) {
            return false;
        }

        if ($this->amountDoesNotMatch($aMoney)) {
            return false;
        }

        return true;
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
     * @return true
     */
    public function isLessThan(Money $anotherMoney): bool
    {
        return $this->amount() < $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isLessThanOrEqualTo(Money $anotherMoney): bool
    {
        return $this->amount() <= $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isGreaterThanOrEqualTo(Money $anotherMoney): bool
    {
        return $this->amount() >= $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isGreaterThan(Money $anotherMoney):bool
    {
        return $this->amount() > $anotherMoney->amount();
    }
}
