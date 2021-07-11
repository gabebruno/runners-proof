<?php


namespace App\Helpers;


use Carbon\Carbon;

class AgeHelper
{
    /**
     * Method for calculate Age from Date of Birth
     *
     * @param $dateOfBirth
     * @return int
     */
    public static function calculateAge($dateOfBirth): int
    {
        return Carbon::parse($dateOfBirth)->age;
    }

    /**
     * Method for validate if target is in legal age.
     *
     * @param $dateOfBirth
     * @return bool
     */
    public static function inLegalAge($dateOfBirth): bool
    {
        $age = self::calculateAge($dateOfBirth);
        return ($age >= 18);
    }
}
