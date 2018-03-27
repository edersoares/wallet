<?php

namespace Tests\Unit;

use Tests\TestCase;
use Wallet\Support\Calculators\IrpfAnnualCalculator;
use Wallet\Support\Calculators\IrpfAnnualProgressiveTables;

class IrpfAnnualCalculatorTest extends TestCase
{
    public function testCalculateUsingSimplifiedDiscount2013()
    {
        $calculator = new IrpfAnnualCalculator(
            IrpfAnnualProgressiveTables::aliquots2013(),
            IrpfAnnualProgressiveTables::limitSimplifiedDiscount2013()
        );

        $this->assertEquals(1119.51, $calculator->calculateUsingSimplifiedDiscount(69940.11, 7427.95));
    }

    public function testCalculateUsingLegalDiscount2013()
    {
        $calculator = new IrpfAnnualCalculator(
            IrpfAnnualProgressiveTables::aliquots2013(),
            IrpfAnnualProgressiveTables::limitSimplifiedDiscount2013()
        );

        $this->assertEquals(1589.32, $calculator->calculateUsingLegalDiscount(69940.11, 7427.95, 15696.44));
    }

    public function testCalculateUsingSimplifiedDiscount2018()
    {
        $calculator = new IrpfAnnualCalculator(
            IrpfAnnualProgressiveTables::aliquots2018(),
            IrpfAnnualProgressiveTables::limitSimplifiedDiscount2018()
        );

        $this->assertEquals(835.69, $calculator->calculateUsingSimplifiedDiscount(50451.91, 2632.35));
    }

    public function testCalculateUsingLegalDiscount2018()
    {
        $calculator = new IrpfAnnualCalculator(
            IrpfAnnualProgressiveTables::aliquots2018(),
            IrpfAnnualProgressiveTables::limitSimplifiedDiscount2018()
        );

        $this->assertEquals(541.58, $calculator->calculateUsingLegalDiscount(50451.91, 2632.35, 8129.65));
    }
}
