<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DifficultyTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function all_difficulties_can_be_retrieved()
    {
        $this->signIn();
        $response = $this->getJson('/api/difficulties')
                    ->assertStatus(200);
    }
}
