<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadCourseTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->type = create('App\Type', ['name' => 'course']);

        $this->course = create('App\Course', ['published' => true, 'type_id' => $this->type->id]);
    }
    
    /** @test */
    public function a_user_can_browse_all_courses()
    {
        //Given 
        $this->get('/courses')
            ->assertSee($this->course->title);
    }

    /** @test */
    public function a_user_can_view_a_single_course()
    {
        $this->get($this->course->path())
            ->assertSee($this->course->title);
    }

    /** @test */
    public function a_user_can_browse_courses_by_subjects()
    {
        $subject = create('App\Subject');
        $courseInSubject = create('App\Course', ['subject_id' => $subject->id, 'published' => true, 'type_id' => $this->type->id]);
        $courseNotInSubject = create('App\Course', ['published' => true, 'type_id' => $this->type->id]);

        $data = $this->json('GET','/courses/' . $subject->slug)->json();
        $this->assertCount(2, $data['data']);

    }

    /** @test */
    public function it_can_be_browse_by_price_lowest_to_highess()
    {
        $firstCourse = create('App\Course', ['amount' => '3000', 'created_at' => Carbon::now()->subWeek(), 'published' => true]);
        $secondCourse = $this->course; 
        $response = $this->getJson('/courses?amount=asc')->json();
        $this->assertEquals([3000, 145000], array_column($response, 'amount'));
    }

        /** @test */
    public function it_can_be_browse_by_price_highest_to_lowest()
    {
        $firstCourse = create('App\Course', ['amount' => '3000', 'created_at' => Carbon::now()->subWeek(), 'published' => true]);
        $secondCourse = $this->course; 

        $response = $this->getJson('/courses?amount=desc')->json();
        $this->assertEquals([145000, 3000], array_column($response, 'amount'));
    }

    /** @test */
    public function it_can_be_browse_by_difficulty()
    {
        $type = create('App\Type', ['name' => 'course']);

        $beginner = create('App\Difficulty', ['level' => 'beginner',]);
        $intermediate = create('App\Difficulty', ['level' => 'intermediate',]);
        $advance = create('App\Difficulty', ['level' => 'advance',]);

        $firstCourse = create('App\Course', ['difficulty_id' => $intermediate->id, 'published' => true, 'type_id' => $type->id]);
        $secondCourse = create('App\Course', ['difficulty_id' => $beginner->id, 'published' => true, 'type_id' => $type->id]);
        $thirdCourse = create('App\Course', ['difficulty_id' => $advance->id, 'published' => true, 'type_id' => $type->id]);


        $this->get('/courses?difficulty=beginner')
            ->assertSee($secondCourse->title);
            // ->assertDontSee($firstCourse->title)
            // ->assertDontSee($thirdCourse->title);
    }

    /** @test */
    public function an_admin_can_retrive_all_courses()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $course = create('App\Course',['type_id' => 1]);
        $track = factory('App\Course')->states('track')->create();

        $courses = $this->getJson('api/courses/allcourses')->json();
        $this->assertCount(2, $courses);
    }

    /** @test */
    public function a_user_can_search_through_courses_by_title()
    {
        $course = create('App\Course', ['title' => 'Mastering in CorelDraw', 'published' => true, 'type_id' => 2]);
        $courseTwo = create('App\Course', ['title' => 'agriculture and farming']);

        $url = 'courses?search=farming';

        $courses = $this->json('GET', $url)->json();
        // dd($courses);
        $this->assertCount(1, $courses);  
    }

    /** @test */
    public function a_user_cannot_see_an_unpublished_course()
    {
        $publishedCoure = create('App\Course', ['published' => true]);
        $unpublishedCoure = create('App\Course', ['published' => false]);

        $data = $this->json('GET', '/courses')->json();
        $this->assertCount(2, $data['data']);
    }
}
