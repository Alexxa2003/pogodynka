<?php

namespace App\Tests\Entity;

use App\Entity\Measurment;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MeasurmentTest extends TestCase
{
    public static function dataGetFahrenheit(): array
    {
        return [
            ['0', '32'],
            ['-100', '-148'],
            ['100', '212'],
            ['0.5', '32.9'],
            ['-0.5', '31.1'],
            ['10', '50'],
            ['20', '68'],
            ['-40', '-40'],
            ['2.5', '36.5'],
            ['-12.5', '9.5'],
        ];
    }

    #[DataProvider('dataGetFahrenheit')]
    public function testGetFahrenheit(string $celsius, string $expectedFahrenheit): void
    {
        $measurement = new Measurment();
        $measurement->setCelsius($celsius);

        $this->assertEquals($expectedFahrenheit, $measurement->getFahrenheit());
    }
}
