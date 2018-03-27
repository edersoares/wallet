<?php

namespace Wallet\Support\Calculators;

class IrpfAnnualProgressiveTables
{
    public static function aliquots2013()
    {
        return [
            ['min' => 0,        'max' => 19645.32, 'aliquot' => 0   , 'deductible' => 0      ],
            ['min' => 19645.33, 'max' => 29442.00, 'aliquot' => 7.5 , 'deductible' => 1473.40],
            ['min' => 29442.01, 'max' => 39256.56, 'aliquot' => 15  , 'deductible' => 3681.55],
            ['min' => 39256.57, 'max' => 49051.80, 'aliquot' => 22.5, 'deductible' => 6625.79],
            ['min' => 49051.80, 'max' => INF,      'aliquot' => 27.5, 'deductible' => 9078.38],
        ];
    }

    public static function aliquots2018()
    {
        return [
            ['min' => 0,        'max' => 22847.76, 'aliquot' => 0   , 'deductible' => 0       ],
            ['min' => 22847.77, 'max' => 33919.80, 'aliquot' => 7.5 , 'deductible' => 1713.58 ],
            ['min' => 33919.81, 'max' => 45012.60, 'aliquot' => 15  , 'deductible' => 4257.57 ],
            ['min' => 45012.61, 'max' => 55976.16, 'aliquot' => 22.5, 'deductible' => 7633.51 ],
            ['min' => 55976,16, 'max' => INF,      'aliquot' => 27.5, 'deductible' => 10432.32],
        ];
    }

    public static function limitSimplifiedDiscount2013()
    {
        return 14542.60;
    }

    public static function limitSimplifiedDiscount2018()
    {
        return 14542.60;
    }
}
