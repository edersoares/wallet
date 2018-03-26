<?php

namespace Wallet\Support\Calculators;

class SalaryCalculator
{
    /**
     * INSS calculator.
     *
     * @var InssCalculator
     */
    protected $inss;

    /**
     * IRPF calculator.
     *
     * @var IrpfCalculator
     */
    protected $irpf;

    /**
     * SalaryCalculator constructor.
     *
     * @param InssCalculator $inss
     * @param IrpfCalculator $irpf
     */
    public function __construct(InssCalculator $inss, IrpfCalculator $irpf)
    {
        $this->inss = $inss;
        $this->irpf = $irpf;
    }

    /**
     * Calculate the salary and taxes.
     *
     * @param float $salary
     *
     * @return array
     */
    public function calculate($salary)
    {
        $inssAliquot = $this->inss->calculateAliquot($salary);
        $inssValue = $this->inss->calculateValue($salary);

        $irpfBase = $salary - $inssValue;
        $irpfAliquot = $this->irpf->calculateAliquot($irpfBase);
        $irpfValue = $this->irpf->calculate($irpfBase);

        $liquid = $salary - $inssValue - $irpfValue;

        return [
            'salary' => $salary,
            'inss' => [
                'aliquot' => $inssAliquot,
                'value' => $inssValue
            ],
            'irpf' => [
                'aliquot' => $irpfAliquot,
                'value' => $irpfValue
            ],
            'liquid' => $liquid
        ];
    }
}
