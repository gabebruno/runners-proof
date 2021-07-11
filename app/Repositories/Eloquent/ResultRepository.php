<?php

namespace App\Repositories\Eloquent;

use App\Models\Result;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\ResultRepositoryInterface;

class ResultRepository extends BaseRepository implements ResultRepositoryInterface
{
    /**
     * @var Result
     */
    protected $model = Result::class;

    /**
     * Get runners by age adding column for age range
     *
     * The list of classifications by age must be show the runners positions
     * inside the following groups in each proof type.
     * o 18 – 25 years
     * o 25 – 35 years
     * o 35 – 45 years
     * o 45 – 55 years
     * o Up to 55 years
     * Example: the positions 18 -25 in 3km race will show the 1º,2º, 3º, ...
     * in this age range, the same for the others ranges and proof types.
     *
     * @return mixed
     */
    public function getRunnersByAge()
    {
        $query = DB::table("runners as ru")->selectRaw('
          CASE
            WHEN (DATEDIFF(now(), ru.birthday) / 365.25) >= 18
                and (DATEDIFF(now(), ru.birthday) / 365.25) <= 25 THEN "18 – 25 years"

            WHEN (DATEDIFF(now(), ru.birthday) / 365.25) >= 26
                and (DATEDIFF(now(), ru.birthday) / 365.25) <= 35 THEN "26 – 35 years"

            WHEN (DATEDIFF(now(), ru.birthday) / 365.25) >= 36
                and (DATEDIFF(now(), ru.birthday) / 365.25) <= 45 THEN "36 – 45 years"

            WHEN (DATEDIFF(now(), ru.birthday) / 365.25) >= 46
                and (DATEDIFF(now(), ru.birthday) / 365.25) <= 55 THEN "46 – 55 years"
            ELSE "55 years up"

            END AS age_range,
            ru.id as runner_id,
            ru.name,
            rr.runner_age,
            ra.id as race_id,
            ra.type as race_type,
            rr.total_time
            ')
            ->join('race_runner as rr', 'rr.runner_id', 'ru.id')
            ->join('races as ra', 'rr.race_id', 'ra.id')
            ->get();

        return $query;
    }

    /**
     * Get general classification by race
     *
     * The list of classifications must be separeted by type of proofs.
     *
     * @return mixed
     */
    public function getGeneralClassification()
    {
        $query = DB::table('races')
            ->join('race_runner as rr', 'rr.race_id', 'races.id')
            ->join('runners as ru', 'rr.runner_id', 'ru.id')
            ->orderBy('races.type')
            ->get();

        return $query;
    }
}
