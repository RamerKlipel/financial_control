<?php
function printr(mixed $mix):void
{
    echo '<pre>';
    print_r($mix);
    echo '</pre>';
}

function getPagesPermissions(): array
{
    return [
        // 'index',
        'categories', 'bills', 'index', 'creditcard'
        //  'reports', 'settings',
    ];
}

function callViewFrom(String $path): void
{
    include_once __DIR__. "/../view/$path.view.php";
}

function getArrPayments(): array
{
    $arrPayments = [
        'PX' => 'Pix',
        'CC' => 'Credit Card',
        'CD' => "Debit Card"
    ];

    return $arrPayments;
}

function formatDateDB($date): null|string
{
    if (empty($date)) {
        return null;
    }
    [$day, $month, $year] = explode('/', $date);
    $blValidDay = $day >= 0 && $day <= 31;
    $blValidMonth = $month >= 1 && $month <= 12;
    $blValidYear = $year >= 1500 && $year <= 9999;

    if ($blValidDay && $blValidMonth && $blValidYear) {
        $date = "$year-$month-$day";
    }
    return $date;
}
