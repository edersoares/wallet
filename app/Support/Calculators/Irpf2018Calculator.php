<?php

namespace Wallet\Support\Calculators;

class Irpf2018Calculator extends IrpfCalculator
{
    /**
     * IrpfCalculator constructor.
     */
    public function __construct()
    {
        parent::__construct([
            ['min' => 0, 'max' => 1903.98, 'aliquot' => 0, 'deductible' => 0],
            ['min' => 1903.99, 'max' => 2826.65, 'aliquot' => 7.5, 'deductible' => 142.80],
            ['min' => 2826.66, 'max' => 3751.05, 'aliquot' => 15, 'deductible' => 354.80],
            ['min' => 3751.06, 'max' => 4664.68, 'aliquot' => 22.5, 'deductible' => 636.13],
            ['min' => 4664.69, 'max' => INF, 'aliquot' => 27.5, 'deductible' => 869.36],
        ]);
    }
}
