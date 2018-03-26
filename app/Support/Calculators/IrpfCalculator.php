<?php

namespace Wallet\Support\Calculators;

class IrpfCalculator
{
    protected $aliquots;

    public function __construct($aliquots)
    {
        $this->aliquots = $aliquots;
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

    public function calculate($value)
    {
        $aliquot = $this->calculateAliquot($value);

        if (empty($aliquot)) {
            return 0;
        }

        $deductible = $this->calculateDeductibleValue($value);

        return round($value * $aliquot / 100 - $deductible, 2);
    }
}
