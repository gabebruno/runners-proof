<?php

namespace Tests;

use App\Models\Race;
use App\Models\Runner;
use App\Models\Classification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('migrate');
    }

    public function fakeRunners() {

        //Create tree fake runners
        $runner1 = new Runner([
            "name" => "Cláudia Clarice Benedita Campos",
            "cpf" => "590.561.818-66",
            "birthday" => "2003-05-23"
        ]);
        $runner1->save();

        $runner2 = new Runner([
            "name" => "Vera Liz Moraes",
            "cpf" => "458.679.725-85",
            "birthday" => "2003-02-13"
        ]);
        $runner2->save();

        $runner3 = new Runner([
            "name" => "Francisco Fernando Giovanni da Luz",
            "cpf" => "102.926.374-46",
            "birthday" => "2003-02-25"
        ]);
        $runner3->save();
    }

    public function fakeRaces() {

        //Create tree fake races
        $race1 = new Race([
            "type"=> 3,
            "date"=> "2021/11/10"
        ]);
        $race1->save();

        $race2 = new Race([
            "type"=> 5,
            "date"=> "2021/11/13"
        ]);
        $race2->save();

        $race3 = new Race([
            "type"=> 10,
            "date"=> "2021/11/15"
        ]);
        $race3->save();
    }

    public function fakeSubscribes() {
        $subscribe1 = new Classification([
            "runner_id"=> 1,
            "race_id"=> 1
        ]);
        $subscribe1->save();
        $subscribe2 = new Classification([
            "runner_id"=> 2,
            "race_id"=> 1
        ]);
        $subscribe2->save();
        $subscribe3 = new Classification([
            "runner_id"=> 3,
            "race_id"=> 2
        ]);
        $subscribe3->save();
    }

    public function fakeResults() {
        $results1 = new Classification([
            "runner_id" => 1,
            "race_id" => 1,
            "begin" => "16:00:00",
            "finish"=> "16:01:38"
        ]);
        $results1->save();
        $results2 = new Classification([
            "runner_id"=> 2,
            "race_id" => 1,
            "begin" => "12:00:00",
            "finish" => "12:02:38"
        ]);
        $results2->save();
        $results3 = new Classification([
            "runner_id" => 3,
            "race_id" => 2,
            "begin" => "14:00:00",
            "finish" => "14:10:14"
        ]);
        $results3->save();
    }


}
