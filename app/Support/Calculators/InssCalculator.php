<?php

namespace Wallet\Support\Calculators;

class InssCalculator
{
    protected $aliquots;

    public function __construct($aliquots)
    {
        $this->aliquots = $aliquots;
    }

    public function getMaxAliquot()
    {
        return array_reduce($this->aliquots, function ($current, $aliquot) {
            return $current > $aliquot['max'] ? $current : $aliquot['aliquot'];
        });
    }

    public function getCeiling()
    {
        return array_reduce($this->aliquots, function ($current, $aliquot) {
            return $current > $aliquot['max'] ? $current : $aliquot['max'];
        });
    }

    public function isCeiling($salary)
    {
        return $salary > $this->getCeiling();
    }

    public function calculateAliquot($salary)
    {
        return array_reduce($this->aliquots, function ($current, $aliquot) use ($salary) {
            return $salary >= $aliquot['min'] && $salary <= $aliquot['max']
                ? $aliquot['aliquot']
                : $current;
        }, $this->getMaxAliquot());
    }

    public function calculateValue($salary)
    {
        if ($this->isCeiling($salary)) {
            return round($this->getCeiling() * $this->getMaxAliquot() / 100, 2);
        }

        return round($salary * $this->calculateAliquot($salary) / 100, 2);
    }
}
