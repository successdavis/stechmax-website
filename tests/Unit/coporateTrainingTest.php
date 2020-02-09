<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class coporateTrainingTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = create('App\User');
        $this->coporatetraining = create('App\coporatetraining');
    }

    /** @test */
    public function a_coporate_training_database_should_contain_the_following_fields()
    {
        $this->assertTrue(Schema::hasColumns('coporatetrainings', [
            'id', "begin_at", "endgoal", "venue", "personal_pc", "user_id"
          ]), 1);
    }

    /** @test */
    public function a_coporatetraining_belongs_to_many_user()
    {
        $this->assertInstanceOf('App\User', $this->coporatetraining->user);
    }

    /** @test */
    public function a_coporatetraining_belongs_to_many_and_has_many_courses()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->coporatetraining->courses);   
    }  

    /** @test */
    public function a_coporatetraining_has_many_class_schedules()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->coporatetraining->classschedule);   
    }
}
