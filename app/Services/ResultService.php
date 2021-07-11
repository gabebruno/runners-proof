<?php

namespace App\Services;

use Illuminate\Support\Arr;
use App\Http\Resources\ClassificationByAgeResource;
use App\Http\Resources\GeneralClassificationResource;
use App\Repositories\Contracts\ResultRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ResultService
{
    /**
     * @var ResultRepositoryInterface
     */
    private $resultRepo;


    public function __construct(ResultRepositoryInterface $resultRepo)
    {
        $this->resultRepo = $resultRepo;
    }

    /**
     * Handler method
     *
     * Used to filter get request to specific method
     *
     * @return AnonymousResourceCollection
     */
    public function getClassifications(): AnonymousResourceCollection
    {
        $byAge = strtolower(request('byAge')) == 'true';

        if ($byAge) {
            return ClassificationByAgeResource::collection($this->getClassificationByAge());
        }
        return GeneralClassificationResource::collection($this->getGeneralClassification());

    }

    /**
     * Get classification by age of runners
     *
     * The list of classifications by age must be show the runners positions
     * inside the following groups in each proof type.
     * 1: 18 – 25 years
     * 2: 25 – 35 years
     * 3: 35 – 45 years
     * 4: 45 – 55 years
     * 5: Up to 55 years
     * Example: the positions 18 -25 in 3km race will show the 1º,2º, 3º, ...
     * in this age range, the same for the others ranges and proof types.
     *
     * @return mixed
     */
    public function getClassificationByAge()
    {
        $ListRunners = $this->resultRepo->getRunnersByAge();
        $ListRaces = $this->resultRepo->getWithOrderBy('type');
        $ListRanges = $this->mapAgeRanges($ListRunners);
        return $this->mapRunnersByRacesWithAgeRange($ListRunners, $ListRaces, $ListRanges);
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
        $results = $this->resultRepo->getGeneralClassification();
        $results = $this->mapRunnersByRacesType($results);
        $results = $this->makeRankingInRunners($results);

        return $results;
    }

    /**
     * Mapping runners by race
     *
     * @param $rawListRunners
     * @param $rawListRaces
     *
     * @return array
     */
    private function mapRunnersByRacesWithAgeRange($ListRunners, $ListRaces, $ranges): array
    {
        $ordenedRaceList = [];

        foreach($ListRaces as $race) {
                $ordenedRaceList[] = [
                    'raceId' => $race->id,
                    'raceType' => $race->type.' Km',
                    'age_range' => $this->mapRunnersWithRanges($ListRunners, $race->id, $ranges)
                ];
        }

        return $ordenedRaceList;
    }

    /**
     * Used to map age range from users
     *
     * @param $rawListRunners
     */
    public function mapAgeRanges($rawListRunners): array
    {
        $ranges = [];
        foreach ($rawListRunners as $runner) {
            if(!in_array($runner->age_range, $ranges)) {
                $ranges[] =  $runner->age_range;
            }
        }
        return Arr::sort($ranges);
    }

    /**
     * Catch all runners on a specific race
     *
     * Using a raw list of runners and race id, this method catch just runners attached to a race.
     *
     * @param $rawListRunners
     * @param $raceId
     *
     * @return array
     */
    private function mapRunnersWithRanges($rawListRunners, $raceId, $ranges): array
    {
        $runnersByRange = [];
        foreach ($ranges as $range) {
            $runner = [];
            foreach ($rawListRunners as $rawRunner) {
                if ($rawRunner->race_id === $raceId && $rawRunner->age_range === $range) {
                    $runner[] = [
                        'race_id' => $rawRunner->race_id,
                        'race_type' => $rawRunner->race_type . ' Km',
                        'runner_id' => $rawRunner->runner_id,
                        'name' => $rawRunner->name,
                        'runner_age' => $rawRunner->runner_age,
                        'total_time' => $rawRunner->total_time,
                        'age_range' => $rawRunner->age_range
                    ];
                }
            }
         $runnersByRange[$range] = $this->makeRankingInRunnersByAge($runner);
        }
        return $runnersByRange;
    }

    /**
     * Map runners to make ranking and show positions
     *
     * Used to make ranking in byAge request
     *
     * @param $runnersList
     *
     * @return array
     */
    public function makeRankingInRunnersByAge($runnersList)
    {
        $runnersList = Arr::sort($runnersList, 'total_time');

        $runnersByRange = [];
        $position = 1;
        foreach($runnersList as $runner) {
            if($runner !== []) {
                $runner['position'] = $position++."st";
            }
            $runnersByRange[] = $runner;
        }
        return $runnersByRange;
    }

    /**
     * Map runners to make ranking and show positions
     *
     * Used to make ranking in general clssifications
     *
     * @param $runnersList
     *
     * @return array
     */
    public function makeRankingInRunners($resultList)
    {

        dd($resultList);
        $resultRanked = [];

        foreach($resultList as $race) {
            $position = 1;
            $resultRankedByRace = [];

            foreach($race['runner'] as $runners) {
                $runners = Arr::sort($runners, 'total_time');

                foreach($runners as $runner) {
                    $runner['position'] = $position++;
                    $runners[] = $runner;
                }

                $resultRankedByRace[] = $runners;
            }

        $resultRanked[] = $resultRankedByRace;
        }
        return $resultList;
    }

    private function mapRunnersByRacesType($results): array
    {
        $runnersByRace = [];
        foreach ($results as $race) {
            $data = [
                'race_id' => $race->race_id,
                'runner' => [
                    $this->getRunnersByRace($results, $race->race_id)
                ],
            ];
            $runnersByRace[$race->type.'Km'][$race->race_id] = $data;
        }
        return $runnersByRace;
    }

    private function getRunnersByRace($results, $raceId): array
    {
        $runnersByRace = [];
        foreach ($results as $runner) {
            if($runner->race_id === $raceId ) {
                $data = [
                    'runner_id' => $runner->id,
                    'name' => $runner->name,
                    'age' => $runner->runner_age,
                    'total_time' => $runner->total_time,
                    'position' => '',
                ];
                $runnersByRace[] = $data;
            }
        }
        return $runnersByRace;
    }
}
