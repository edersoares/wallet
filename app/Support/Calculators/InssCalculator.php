<?php

namespace Wallet\Support\Calculators;

class InssCalculator
{
    /**
     * Aliquots.
     *
     * @var array
     */
    protected $aliquots;

    /**
     * InssCalculator constructor.
     *
     * @param array $aliquots
     */
    public function __construct($aliquots)
    {
        $this->aliquots = $aliquots;
    }

    /**
     * Return the max aliquot percent value.
     *
     * @return float
     */
    public function getMaxAliquot()
    {
        return array_reduce($this->aliquots, function ($current, $aliquot) {
            return $current > $aliquot['max'] ? $current : $aliquot['aliquot'];
        });
    }

    /**
     * Return the ceiling value.
     *
     * @return float
     */
    public function getCeiling()
    {
        return array_reduce($this->aliquots, function ($current, $aliquot) {
            return $current > $aliquot['max'] ? $current : $aliquot['max'];
        });
    }

    /**
     * Indicate if value is greater than ceiling.
     *
     * @param float $value
     *
     * @return bool
     */
    public function isCeiling($value)
    {
        return $value > $this->getCeiling();
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
        }, $this->getMaxAliquot());
    }

    /**
     * Return the tax value.
     *
     * @param float $value
     *
     * @return float
     */
    public function calculateValue($value)
    {
        if ($this->isCeiling($value)) {
            return round($this->getCeiling() * $this->getMaxAliquot() / 100, 2);
        }

        return round($value * $this->calculateAliquot($value) / 100, 2);
    }
}
