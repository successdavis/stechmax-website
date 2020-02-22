<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class readbusinessTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->business = create('App\Business');
    }

    /** @test */
    public function a_user_can_browse_all_business()
    {
    	$this->get('/pricing')
            ->assertSee($this->business->name);
    }
}
