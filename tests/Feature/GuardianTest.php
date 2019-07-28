<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GuardianTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    
    /** @test */
    public function a_guardian_can_be_added_by_a_user()
    {
        $user = create('App\User');
        $guardian = make('App\Guardian');
        $this->post(route('guardian.store', ['user' => $user->username]), $guardian->toArray())
        	->assertStatus(201);
        $this->assertDatabaseHas('guardians', ['name' => $guardian->name]);
    }

    /** @test */
    public function a_guardian_can_be_updated_by_a_user()
    {
        $user = create('App\User');
        $guardian = create('App\Guardian', ['user_id' => $user->id]);
        $updatedGuardian = $guardian->toArray();
        $updatedGuardian['name'] = 'changed name';
        $updatedGuardian['phone'] = '08055898969';

        $this->patch(route('guardian.update', ['user' => $guardian->id]), $updatedGuardian);

        tap($guardian->fresh(), function ($guardian) {
                $this->assertEquals($guardian->name, 'changed name');
                $this->assertEquals('08055898969', $guardian->phone);
            });
    }
}
