<?php

namespace spec\EricksonReyes\DomainDrivenDesign\ValueObject;

use EricksonReyes\DomainDrivenDesign\ValueObject\Currency;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\SeederAwareUnitTest;

/**
 * Class CurrencySpec
 * @package spec\EricksonReyes\DomainDrivenDesign\ValueObject
 *
 */
class CurrencySpec extends ObjectBehavior
{
    use SeederAwareUnitTest;

    /**
     * @var string
     */
    private string $code;

    public function let(): void
    {
        $this->beConstructedWith(
            $this->code = $this->seeder->currencyCode
        );
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Currency::class);
    }

    public function it_has_currency_code(): void
    {
        $this->code()->shouldReturn($this->code);
    }

    public function it_can_be_converted_to_string(): void
    {
        $this->__toString()->shouldReturn($this->code);
    }

    public function it_can_be_matched(Currency $anotherCurrency): void
    {
        $anotherCurrency->code()->shouldBeCalled()->willReturn($this->code);
        $this->matches($anotherCurrency)->shouldReturn(true);
        $this->doesNotMatch($anotherCurrency)->shouldReturn(false);
    }

    public function it_can_be_mismatched(Currency $anotherCurrency): void
    {
        $aDifferentCurrencyCode = null;
        while (true) {
            $aDifferentCurrencyCode = $this->seeder->currencyCode;
            if ($aDifferentCurrencyCode !== $this->code) {
                break;
            }
        }

        $anotherCurrency->code()->shouldBeCalled()->willReturn($aDifferentCurrencyCode);

        $this->matches($anotherCurrency)->shouldReturn(false);
        $this->doesNotMatch($anotherCurrency)->shouldReturn(true);
    }
}
