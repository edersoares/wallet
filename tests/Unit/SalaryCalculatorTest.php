<?php

namespace Tests\Unit;

use Tests\TestCase;
use Wallet\Support\Calculators\InssCalculator;
use Wallet\Support\Calculators\IrpfCalculator;
use Wallet\Support\Calculators\SalaryCalculator;

class SalaryCalculatorTest extends TestCase
{
    protected $calculator;

    protected function setUp()
    {
        parent::setUp();

        $inss = new InssCalculator([
            ['min' => 0,       'max' => 1693.72, 'aliquot' => 8],
            ['min' => 1693.73, 'max' => 2822.90, 'aliquot' => 9],
            ['min' => 2822.91, 'max' => 5645.80, 'aliquot' => 11]
        ]);

        $irpf = new IrpfCalculator([
            ['min' => 0, 'max' => 1903.98, 'aliquot' => 0, 'deductible' => 0],
            ['min' => 1903.99, 'max' => 2826.65, 'aliquot' => 7.5, 'deductible' => 142.80],
            ['min' => 2826.66, 'max' => 3751.05, 'aliquot' => 15, 'deductible' => 354.80],
            ['min' => 3751.06, 'max' => 4664.68, 'aliquot' => 22.5, 'deductible' => 636.13],
            ['min' => 4664.69, 'max' => INF, 'aliquot' => 27.5, 'deductible' => 869.36],
        ]);

        $this->calculator = new SalaryCalculator($inss, $irpf);
    }

    public function testCalculate2700()
    {
        $expected = [
            'salary' => 2700,
            'inss' => [
                'aliquot' => 9,
                'value' => 243
            ],
            'irpf' => [
                'aliquot' => 7.5,
                'value' => 41.48
            ],
            'liquid' => 2415.52
        ];

        $this->assertArraySubset($expected, $this->calculator->calculate(2700));
    }

    public function testCalculate4000()
    {
        $expected = [
            'salary' => 4000,
            'inss' => [
                'aliquot' => 11,
                'value' => 440
            ],
            'irpf' => [
                'aliquot' => 15,
                'value' => 179.20
            ],
            'liquid' => 3380.80
        ];

        $this->assertArraySubset($expected, $this->calculator->calculate(4000));
    }

    public function testCalculate5400()
    {
        $expected = [
            'salary' => 5400,
            'inss' => [
                'aliquot' => 11,
                'value' => 594
            ],
            'irpf' => [
                'aliquot' => 27.5,
                'value' => 452.29
            ],
            'liquid' => 4353.71
        ];

        $this->assertArraySubset($expected, $this->calculator->calculate(5400));
    }
}
