<?php

namespace Tests\Feature;

use Tests\TestCase;

class ResultsTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function check_status_response_results_with_age()
    {
        $this->fakeRaces();
        $this->fakeRunners();
        $this->fakeResults();

        $this->get(route('classifications.get', ['byAge' => true]))
            ->assertStatus(200);
    }

    /**
     * @test
     *
     * @return void
     */
    public function check_status_response_results_without_age()
    {
        $this->get('/api/results')
            ->assertStatus(200);
    }
}
