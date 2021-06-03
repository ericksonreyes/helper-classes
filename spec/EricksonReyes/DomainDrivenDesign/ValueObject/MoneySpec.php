<?php

namespace spec\EricksonReyes\DomainDrivenDesign\ValueObject;

use EricksonReyes\DomainDrivenDesign\ValueObject\Currency;
use EricksonReyes\DomainDrivenDesign\ValueObject\Money;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\SeederAwareUnitTest;

/**
 * Class MoneySpec
 * @package spec\EricksonReyes\DomainDrivenDesign\ValueObject
 */
class MoneySpec extends ObjectBehavior
{
    use SeederAwareUnitTest;

    /**
     * @var Currency
     */
    private Currency $currency;

    /**
     * @var int
     */
    private int $amount;

    public function let()
    {
        $this->beConstructedWith(
            $this->amount = $this->seeder->numberBetween(10, 100),
            $this->currency = new Currency($this->seeder->currencyCode)
        );
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Money::class);
    }

    public function it_has_currency_code(): void
    {
        $this->currency()->shouldReturn($this->currency);
    }

    public function it_has_an_amount(): void
    {
        $this->amount()->shouldReturn($this->amount);
    }

    public function it_can_compared_for_mismatching_currencies(Money $anotherMoney, Currency $anotherCurrency): void
    {
        while (true) {
            $anotherCurrencyCode = $this->seeder->currencyCode;
            if ($anotherCurrencyCode !== $this->currency->code()) {
                $anotherCurrency->code()->shouldBeCalled()->willReturn($anotherCurrencyCode);
                $anotherMoney->currency()->shouldBeCalled()->willReturn($anotherCurrency);
                break;
            }
        }

        $this->matches($anotherMoney)->shouldReturn(false);
        $this->doesNotMatch($anotherMoney)->shouldReturn(true);
    }


    public function it_can_be_compared_against_a_money_with_greater_amount(Money $aMoneyWithABiggerAmount): void
    {
        $aMoneyWithABiggerAmount->currency()->shouldBeCalled()->willReturn($this->currency);
        $aMoneyWithABiggerAmount->amount()->shouldBeCalled()->willReturn($this->amount + 1);

        $this->matches($aMoneyWithABiggerAmount)->shouldReturn(false);
        $this->doesNotMatch($aMoneyWithABiggerAmount)->shouldReturn(true);

        $this->isLessThan($aMoneyWithABiggerAmount)->shouldReturn(true);
        $this->isLessThanOrEqualTo($aMoneyWithABiggerAmount)->shouldReturn(true);

        $this->isGreaterThan($aMoneyWithABiggerAmount)->shouldReturn(false);
        $this->isGreaterThanOrEqualTo($aMoneyWithABiggerAmount)->shouldReturn(false);
    }


    public function it_can_be_compared_against_a_money_with_lesser_amount(Money $aMoneyWithASmallerAmount): void
    {
        $aMoneyWithASmallerAmount->currency()->shouldBeCalled()->willReturn($this->currency);
        $aMoneyWithASmallerAmount->amount()->shouldBeCalled()->willReturn($this->amount - 1);

        $this->matches($aMoneyWithASmallerAmount)->shouldReturn(false);
        $this->doesNotMatch($aMoneyWithASmallerAmount)->shouldReturn(true);

        $this->isLessThan($aMoneyWithASmallerAmount)->shouldReturn(false);
        $this->isLessThanOrEqualTo($aMoneyWithASmallerAmount)->shouldReturn(false);

        $this->isGreaterThan($aMoneyWithASmallerAmount)->shouldReturn(true);
        $this->isGreaterThanOrEqualTo($aMoneyWithASmallerAmount)->shouldReturn(true);
    }

    public function it_can_be_compared_against_another_money_with_equal_amount(Money $aMoneyWithMatchingAmount): void
    {
        $aMoneyWithMatchingAmount->currency()->shouldBeCalled()->willReturn($this->currency);
        $aMoneyWithMatchingAmount->amount()->shouldBeCalled()->willReturn($this->amount);

        $this->matches($aMoneyWithMatchingAmount)->shouldReturn(true);
        $this->doesNotMatch($aMoneyWithMatchingAmount)->shouldReturn(false);

        $this->isLessThan($aMoneyWithMatchingAmount)->shouldReturn(false);
        $this->isLessThanOrEqualTo($aMoneyWithMatchingAmount)->shouldReturn(true);

        $this->isGreaterThan($aMoneyWithMatchingAmount)->shouldReturn(false);
        $this->isGreaterThanOrEqualTo($aMoneyWithMatchingAmount)->shouldReturn(true);
    }

    public function it_can_be_compared_against_another_money_with_mismatched_amount(
        Money $aMoneyWithMismatchedAmount
    ): void {
        $aMoneyWithMismatchedAmount->currency()->shouldBeCalled()->willReturn($this->currency);
        while (true) {
            $aDifferentAmount = $this->seeder->numberBetween(10, 100);
            if ($aDifferentAmount !== $this->amount) {
                $aMoneyWithMismatchedAmount->amount()->shouldBeCalled()->willReturn($aDifferentAmount);
                break;
            }
        }

        $this->matches($aMoneyWithMismatchedAmount)->shouldReturn(false);
        $this->doesNotMatch($aMoneyWithMismatchedAmount)->shouldReturn(true);
    }

    public function it_can_be_compared_if_the_amount_matches_the_expectation(): void
    {
        $anEqualAmount = $this->amount;

        $this->amountIsLessThan($anEqualAmount)->shouldReturn(false);
        $this->amountMatches($anEqualAmount)->shouldReturn(true);
        $this->amountIsGreaterThan($anEqualAmount)->shouldReturn(false);
    }

    public function it_can_be_compared_if_the_amount_is_less_than_expected(): void
    {
        $aGreaterAmount = $this->amount + 1;

        $this->amountIsLessThan($aGreaterAmount)->shouldReturn(true);
        $this->amountMatches($aGreaterAmount)->shouldReturn(false);
        $this->amountIsGreaterThan($aGreaterAmount)->shouldReturn(false);
    }

    public function it_can_be_compared_if_the_amount_is_greater_than_expected(): void
    {
        $aLesserAmount = $this->amount - 1;

        $this->amountIsLessThan($aLesserAmount)->shouldReturn(false);
        $this->amountMatches($aLesserAmount)->shouldReturn(false);
        $this->amountIsGreaterThan($aLesserAmount)->shouldReturn(true);
    }
}
