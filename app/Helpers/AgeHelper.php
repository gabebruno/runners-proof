<?php


namespace App\Helpers;


use Carbon\Carbon;

class AgeHelper
{
    /**
     * @param $dateOfBirth
     * @return int
     */
    public function calculateAge($dateOfBirth): int
    {
        return Carbon::parse($dateOfBirth)->age;
    }

    /**
     * @param $dateOfBirth
     * @return bool
     */
    public function inLegalAge($dateOfBirth): bool
    {
        $age = $this->calculateAge($dateOfBirth);
        return ($age >= 18);
    }
}
