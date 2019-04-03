<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TypeTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function all_types_can_be_retrieved()
    {
        $this->signIn();
        $response = $this->getJson('/api/types')
                    ->assertStatus(200);
    }
}
