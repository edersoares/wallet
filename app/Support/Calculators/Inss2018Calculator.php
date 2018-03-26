<?php

namespace Wallet\Support\Calculators;

class Inss2018Calculator extends InssCalculator
{
    /**
     * InssCalculator constructor.
     */
    public function __construct()
    {
        parent::__construct([
            ['min' => 0,       'max' => 1693.72, 'aliquot' => 8],
            ['min' => 1693.73, 'max' => 2822.90, 'aliquot' => 9],
            ['min' => 2822.91, 'max' => 5645.80, 'aliquot' => 11]
        ]);
    }
}
