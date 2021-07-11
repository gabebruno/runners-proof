<?php


namespace App\Helpers;


use Carbon\Carbon;

class AgeHelper
{
    /**
     * @param $dateOfBirth
     * @return int
     */
    public static function calculateAge($dateOfBirth): int
    {
        return Carbon::parse($dateOfBirth)->age;
    }

    /**
     * @param $dateOfBirth
     * @return bool
     */
    public static function inLegalAge($dateOfBirth): bool
    {
        $age = self::calculateAge($dateOfBirth);
        return ($age >= 18);
    }
}
