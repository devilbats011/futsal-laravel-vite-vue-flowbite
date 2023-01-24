<?php

use Illuminate\Support\Str;

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

function GenerateSomeSaltyRandomCode()
{
    //EG OUTPUT: 1099-7M6V
    return mt_rand(1000, 9999)."-".strtoupper(Str::random(4));
}

function convertTo12hoursFormat($hoursRaw) {
    $hours = $hoursRaw;
    $AmOrPm = $hours >= 12 ? ' pm' : ' am';
    if($hours == 24) $AmOrPm = ' am';
    $hours = $hours <= 12 ? $hours : $hours - 12 ;
    $finalTime = $hours . $AmOrPm;
    return $finalTime;
}

function totalHours ($start,$end) {
    return intval($end) - intval($start);
}
