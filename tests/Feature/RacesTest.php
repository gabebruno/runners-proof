<?php

namespace Tests\Feature;

use Tests\TestCase;

class RacesTest extends TestCase
{
    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function store_races()
    {
        $jsonRequest = [
            [        "type"=> 3,
                "date"=> "2021/10/30"
            ],
            [        "type"=> 5,
                "date"=> "2021/10/30"
            ],
            [        "type"=> 3,
                "date"=> "2021/09/30"
            ],
            [        "type"=> 5,
                "date"=> "2021/09/15"
            ],
            [        "type"=> 25,
                "date"=> "2021/09/15"
            ],
            [        "type"=> 20,
                "date"=> "2021/11/15"
            ],
            [
                "type"=> 20,
                "date"=> "2021/11/30"
            ],
            [
                "type"=> 25,
                "date"=> "2021/11/30"
            ]
        ];

        $header = [
            'Accept' => "application/json"
        ];

        $this->withoutExceptionHandling();

        $this->json('POST', route('races.store'), $jsonRequest)
        ->assertStatus(201);
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function check_validation_errors_missing_field()
    {
        $jsonRequest = [
            [
                "date" => "2021-08-09",
            ],
            [
                "type" => "2021-08-09",
            ]
        ];

        $this->post(route('races.store'),
            $jsonRequest)
            ->assertStatus(422);
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function check_validation_errors_field_not_valid()
    {
        $jsonRequest = [
            [
                "type" => 10,
                "date" => "2021",
            ]
        ];

        $response = $this->post(route('races.store'), $jsonRequest);
        $response->assertStatus(422);
    }
    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function subscribe_runners_in_races()
    {
        $this->withExceptionHandling();

        $this->fakeRaces();
        $this->fakeRunners();

        $jsonRequest = [
            [
                "runner_id"=> 1,
                "race_id"=> 1
            ],
            [
                "runner_id"=> 2,
                "race_id"=> 1
            ],
            [
                "runner_id"=> 3,
                "race_id"=> 2
            ],
            [
                "runner_id"=> 1,
                "race_id"=> 3
            ]
        ];

        $this->json('POST', route('races.subscribe'), $jsonRequest)
            ->assertStatus(201);
    }

}
