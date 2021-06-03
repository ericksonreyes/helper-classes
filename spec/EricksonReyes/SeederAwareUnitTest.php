<?php


namespace spec\EricksonReyes;

use Faker\Factory;
use Faker\Generator;

/**
 * Trait SeederAwareUnitTest
 * @package spec\EricksonReyes
 */
trait SeederAwareUnitTest
{

    /**
     * @var Generator;
     */
    private Generator $seeder;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }
}
