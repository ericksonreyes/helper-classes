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
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }
}
