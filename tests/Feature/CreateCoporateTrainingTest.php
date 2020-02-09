<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateCoporateTrainingTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = create('App\User');
    }

    /** @test */
    public function a_coporate_training_can_be_created_for_a_user()
    {
        $this->publishCoporateTraining();

        $this->assertCount(1, $this->user->coporatetrainings);
    }

    /** @test */
    public function schedules_can_be_added_for_coporate_training()
    {
        $coporatetraining = $this->publishCoporateTraining();
        $schedule = make('App\Classschedule', [], 3);

        $coporatetraining->addSchedule($schedule->toArray());

        $this->assertCount(3, $coporatetraining->classSchedule);
    }


    /** @test */
    public function a_user_can_add_maximum_of_3_lectures_schedule_only()
    {
        $coporatetraining = $this->publishCoporateTraining();
        $schedule = make('App\Classschedule',[], 6);

        $this->expectException('Exception');
        $coporatetraining->addSchedule($schedule->toArray());
    }


    /** @test */
    public function courses_can_be_attached_to_a_coporate_training()
    {
        $coporatetraining = $this->publishCoporateTraining();
        $createdCourses = create('App\Course',[], 10);
        $courses = [1,2,3,4,5];

        $coporatetraining->addCourses($courses);

        $this->assertCount(5, $coporatetraining->courses);
    }

    /** @test */
    public function a_user_can_subscribe_to_a_coporate_program()
    {
        $this->signIn($this->user);
        create('App\Course', [], 10);

        $coporate   = make('App\coporatetraining');
        $courses    = [1,2,3,4,5];
        $schedule   = make('App\Classschedule', [], 3);

        $this->json('POST', 'coporate/registration', [
            'coporate'      => $coporate,
            'courses'       => $courses,
            'schedule'      => $schedule
        ]);
           $this->assertCount(1, $this->user->coporatetrainings);
    }

    public function publishCoporateTraining()
    {
        $coporate = make('App\coporatetraining');

        return $this->user->createCoporateTraining($coporate);
    }

}
