<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Wallet\Support\Calculators\InssCalculator;
use Wallet\Support\Calculators\IrpfCalculator;

class IrpfCalculatorTest extends TestCase
{
    protected $calculator;

    protected function setUp()
    {
        parent::setUp();

        $this->calculator = new IrpfCalculator([
            ['min' => 0, 'max' => 1903.98, 'aliquot' => 0, 'deductible' => 0],
            ['min' => 1903.99, 'max' => 2826.65, 'aliquot' => 7.5, 'deductible' => 142.80],
            ['min' => 2826.66, 'max' => 3751.05, 'aliquot' => 15, 'deductible' => 354.80],
            ['min' => 3751.06, 'max' => 4664.68, 'aliquot' => 22.5, 'deductible' => 636.13],
            ['min' => 4664.69, 'max' => INF, 'aliquot' => 27.5, 'deductible' => 869.36],
        ]);
    }

    public function testCalculateAliquot()
    {
        $this->assertEquals(0, $this->calculator->calculateAliquot(1903.98));
        $this->assertEquals(7.5, $this->calculator->calculateAliquot(1903.99));
        $this->assertEquals(7.5, $this->calculator->calculateAliquot(2826.65));
        $this->assertEquals(15, $this->calculator->calculateAliquot(2826.66));
        $this->assertEquals(15, $this->calculator->calculateAliquot(3751.05));
        $this->assertEquals(22.5, $this->calculator->calculateAliquot(3751.06));
        $this->assertEquals(22.5, $this->calculator->calculateAliquot(4664.68));
        $this->assertEquals(27.5, $this->calculator->calculateAliquot(4664.69));
        $this->assertEquals(27.5, $this->calculator->calculateAliquot(10000));
    }

    public function testCalculateDeductibleValue()
    {
        $this->assertEquals(0, $this->calculator->calculateDeductibleValue(1903.98));
        $this->assertEquals(142.80, $this->calculator->calculateDeductibleValue(1903.99));
        $this->assertEquals(142.80, $this->calculator->calculateDeductibleValue(2826.65));
        $this->assertEquals(354.80, $this->calculator->calculateDeductibleValue(2826.66));
        $this->assertEquals(354.80, $this->calculator->calculateDeductibleValue(3751.05));
        $this->assertEquals(636.13, $this->calculator->calculateDeductibleValue(3751.06));
        $this->assertEquals(636.13, $this->calculator->calculateDeductibleValue(4664.68));
        $this->assertEquals(869.36, $this->calculator->calculateDeductibleValue(4664.69));
        $this->assertEquals(869.36, $this->calculator->calculateDeductibleValue(10000));
    }

    public function testCalculate()
    {
        $this->assertEquals(0, $this->calculator->calculate(1903.98));
        $this->assertEquals(41.48, $this->calculator->calculate(2457.00));
        $this->assertEquals(179.20, $this->calculator->calculate(3560.00));
        $this->assertEquals(452.29, $this->calculator->calculate(4806.00));
        $this->assertEquals(1022.35, $this->calculator->calculate(6878.96));
    }
}
