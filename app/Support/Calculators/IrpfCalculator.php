<?php

namespace Wallet\Support\Calculators;

class IrpfCalculator
{
    /**
     * Aliquots.
     *
     * @var array
     */
    protected $aliquots;

    /**
     * IrpfCalculator constructor.
     *
     * @param array $aliquots
     */
    public function __construct($aliquots)
    {
        $this->aliquots = $aliquots;
    }

    /**
     * Return the aliquot percent value.
     *
     * @param float $value
     *
     * @return float
     */
    public function calculateAliquot($value)
    {
        return array_reduce($this->aliquots, function ($current, $aliquot) use ($value) {
            return $value >= $aliquot['min'] && $value <= $aliquot['max']
                ? $aliquot['aliquot']
                : $current;
        }, 0);
    }

    /**
     * Return the deductible value.
     *
     * @param float $value
     *
     * @return float
     */
    public function calculateDeductibleValue($value)
    {
        return array_reduce($this->aliquots, function ($current, $aliquot) use ($value) {
            return $value >= $aliquot['min'] && $value <= $aliquot['max']
                ? $aliquot['deductible']
                : $current;
        }, 0);
    }

    /**
     * Return the tax value.
     *
     * @param float $value
     *
     * @return float
     */
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
