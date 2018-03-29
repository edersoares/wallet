<?php

namespace Wallet\Console\Commands;

use Illuminate\Console\Command;
use Wallet\Support\Calculators\Inss2018Calculator;
use Wallet\Support\Calculators\Irpf2018Calculator;
use Wallet\Support\Calculators\SalaryCalculator;

class SalaryCompareCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary:compare {salaries*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the salary and taxes';

    /**
     * Calculator.
     *
     * @var SalaryCalculator
     */
    protected $calculator;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $inss = new Inss2018Calculator();
        $irpf = new Irpf2018Calculator();
        $this->calculator = new SalaryCalculator($inss, $irpf);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $salaries = collect($this->argument('salaries'))
            ->map(function ($salary) {
                return $this->calculator->calculate($salary);
            })->map(function ($salary) {

                $value = $salary['salary'];
                $fgts = round($value * 8 / 100, 2);
                $twelfthPart = $thirteenth = round($value / 12, 2);
                $vacations = round($twelfthPart + $twelfthPart * 0.4, 2);
                $total = $value + $fgts + $thirteenth + $vacations;

                return [
                    $value,
                    $salary['inss']['value'],
                    $salary['irpf']['value'],
                    $fgts,
                    $thirteenth,
                    $vacations,
                    $total,
                    $salary['liquid'],
                ];
            })->toArray();

        $this->table([
            'Salary', 'INSS (-)', 'IRPF (-)', 'FGTS (+)', 'Thirteenth (+)', 'Vacations (+)', 'Total', 'Liquid',
        ], $salaries);
    }
}
