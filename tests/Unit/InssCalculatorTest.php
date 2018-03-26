<?php

namespace Tests\Unit;

use Tests\TestCase;
use Wallet\Support\Calculators\InssCalculator;

class InssCalculatorTest extends TestCase
{
    protected $calculator;

    protected function setUp()
    {
        parent::setUp();

        $this->calculator = new InssCalculator([
            ['min' => 0,       'max' => 1693.72, 'aliquot' => 8],
            ['min' => 1693.73, 'max' => 2822.90, 'aliquot' => 9],
            ['min' => 2822.91, 'max' => 5645.80, 'aliquot' => 11]
        ]);
    }

    public function testGetAliquot()
    {
        $aliquot1500 = $this->calculator->calculateAliquot(1500);
        $aliquot1700 = $this->calculator->calculateAliquot(1700);
        $aliquot2700 = $this->calculator->calculateAliquot(2700);
        $aliquot2900 = $this->calculator->calculateAliquot(2900);
        $aliquot5600 = $this->calculator->calculateAliquot(5600);
        $aliquot5700 = $this->calculator->calculateAliquot(5700);

        $this->assertEquals(8, $aliquot1500);
        $this->assertEquals(9, $aliquot1700);
        $this->assertEquals(9, $aliquot2700);
        $this->assertEquals(11, $aliquot2900);
        $this->assertEquals(11, $aliquot5600);
        $this->assertEquals(11, $aliquot5700);
    }

    public function testGetMaxAliquot()
    {
        $this->assertEquals(11, $this->calculator->getMaxAliquot());
    }

    public function testGetCeiling()
    {
        $this->assertEquals(5645.80, $this->calculator->getCeiling());
    }

    public function testIsCeiling()
    {
        $this->assertTrue($this->calculator->isCeiling(10000));
        $this->assertFalse($this->calculator->isCeiling(5000));
    }

    public function testSalary1500()
    {
        $salary = 1500;
        $aliquot = 8;
        $value = round($salary * $aliquot / 100, 2);

        $this->assertEquals($value, $this->calculator->calculateValue($salary));
        $this->assertEquals($aliquot, $this->calculator->calculateAliquot($salary));
        $this->assertFalse($this->calculator->isCeiling($salary));
    }

    public function testSalary1700()
    {
        $salary = 1700;
        $aliquot = 9;
        $value = round($salary * $aliquot / 100, 2);

        $this->assertEquals($value, $this->calculator->calculateValue($salary));
        $this->assertEquals($aliquot, $this->calculator->calculateAliquot($salary));
        $this->assertFalse($this->calculator->isCeiling($salary));
    }

    public function testSalary2700()
    {
        $salary = 2700;
        $aliquot = 9;
        $value = round($salary * $aliquot / 100, 2);

        $this->assertEquals($value, $this->calculator->calculateValue($salary));
        $this->assertEquals($aliquot, $this->calculator->calculateAliquot($salary));
        $this->assertFalse($this->calculator->isCeiling($salary));
    }

    public function testSalary2900()
    {
        $salary = 2900;
        $aliquot = 11;
        $value = round($salary * $aliquot / 100, 2);

        $this->assertEquals($value, $this->calculator->calculateValue($salary));
        $this->assertEquals($aliquot, $this->calculator->calculateAliquot($salary));
        $this->assertFalse($this->calculator->isCeiling($salary));
    }

    public function testSalary5600()
    {
        $salary = 5600;
        $aliquot = 11;
        $value = round($salary * $aliquot / 100, 2);

        $this->assertEquals($value, $this->calculator->calculateValue($salary));
        $this->assertEquals($aliquot, $this->calculator->calculateAliquot($salary));
        $this->assertFalse($this->calculator->isCeiling($salary));
    }

    public function testSalary5700()
    {
        $salary = 5700;
        $aliquot = 11;
        $value = 621.04;

        $this->assertEquals($value, $this->calculator->calculateValue($salary));
        $this->assertEquals($aliquot, $this->calculator->calculateAliquot($salary));
        $this->assertTrue($this->calculator->isCeiling($salary));
    }
}
