<?php

namespace Wallet\Support\Calculators;

class IrpfAnnualCalculator
{
    const ALIQUOT_SIMPLIFIED_DISCOUNT = 20;

    protected $aliquots;

    protected $limitSimplifiedDiscount;

    public function __construct($aliquots, $limitSimplifiedDiscount)
    {
        $this->aliquots = $aliquots;
        $this->limitSimplifiedDiscount = $limitSimplifiedDiscount;
    }

    public function calculateAliquot($value)
    {
        return array_reduce($this->aliquots, function ($current, $aliquot) use ($value) {
            return $value >= $aliquot['min'] && $value <= $aliquot['max']
                ? $aliquot['aliquot']
                : $current;
        }, 0);
    }

    public function calculateDeductibleValue($value)
    {
        return array_reduce($this->aliquots, function ($current, $aliquot) use ($value) {
            return $value >= $aliquot['min'] && $value <= $aliquot['max']
                ? $aliquot['deductible']
                : $current;
        }, 0);
    }

    public function calculateUsingLegalDiscount($income, $taxWithheld, $deductions)
    {
        $base = $income - $deductions;

        $aliquot = $this->calculateAliquot($base);
        $deduction = $this->calculateDeductibleValue($base);

        $tax = $base * $aliquot / 100 - $deduction;

        return round($taxWithheld - $tax, 2);
    }

    public function calculateUsingSimplifiedDiscount($income, $taxWithheld)
    {
        $discount = $income * self::ALIQUOT_SIMPLIFIED_DISCOUNT / 100;

        if ($discount > $this->limitSimplifiedDiscount) {
            $discount = $this->limitSimplifiedDiscount;
        }

        $base = $income - $discount;

        $aliquot = $this->calculateAliquot($base);
        $deduction = $this->calculateDeductibleValue($base);

        $tax = $base * $aliquot / 100 - $deduction;

        return round($taxWithheld - $tax, 2);
    }
}
