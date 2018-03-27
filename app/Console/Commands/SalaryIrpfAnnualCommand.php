<?php

namespace Wallet\Console\Commands;

use Illuminate\Console\Command;
use Wallet\Support\Calculators\IrpfAnnualCalculator;
use Wallet\Support\Calculators\IrpfAnnualProgressiveTables;

class SalaryIrpfAnnualCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary:irpf:annual {income} {taxWithheld} {deductions}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Calculator.
     *
     * @var IrpfAnnualCalculator
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

        $this->calculator = new IrpfAnnualCalculator(
            IrpfAnnualProgressiveTables::aliquots2018(),
            IrpfAnnualProgressiveTables::limitSimplifiedDiscount2018()
        );
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $income = $this->argument('income');
        $taxWithheld = $this->argument('taxWithheld');
        $deductions = $this->argument('deductions');

        $simplified = $this->calculator->calculateUsingSimplifiedDiscount($income, $taxWithheld);
        $legal = $this->calculator->calculateUsingLegalDiscount($income, $taxWithheld, $deductions);

        $this->table([
            'Simplified Discount', 'Legal Discount'
        ], [[
            $simplified, $legal
        ]]);
    }
}
