<?php


namespace App\Helpers;


use Carbon\Carbon;

class AgeHelper
{
    function calculateAge($dateOfBirth): int
    {
        return Carbon::parse($dateOfBirth)->age;
    }

    function inLegalAge($dateOfBirth): bool
    {
        $age = $this->calculateAge($dateOfBirth);
        return ($age >= 18);
    }
}
