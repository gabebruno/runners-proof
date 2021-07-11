<?php

namespace Tests\Feature;

use Tests\TestCase;

class ClassificationsTest extends TestCase
{

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function put_classifications()
    {
        $this->fakeRunners();
        $this->fakeRaces();
        $this->fakeSubscribes();

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
            ]
        ];

        $this->withoutExceptionHandling();

        $this->json('PUT', route('classifications.register'))
        ->assertStatus(201);
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function put_classifications_with_missing_field()
    {
        $this->fakeRaces();
        $this->fakeRunners();
        $this->fakeSubscribes();

        $jsonRequest = [
            [
                "runner_id"=> 1,
                "race_id" => 1
            ]
        ];

        $this->json('PUT', route('classifications.register'), $jsonRequest)
            ->assertStatus(422);
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function put_classifications_without_existing_id()
    {
        $jsonRequest = [
            [
                "race_id" => 1000,
                "runner_id"=> 1000
            ]
        ];

        $this->json('PUT', route('classifications.register'), $jsonRequest)
            ->assertStatus(404);
    }
}
