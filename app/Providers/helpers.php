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
