<?php

namespace Tests\Feature;

use App\Fee;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class FeeTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->course = create('App\Course');
    }

    /** @test */
    public function a_classroom_fee_can_be_retrieved()
    {
    	$fee = create('App\Fee',['amount' => 5000]);
    	$this->assertEquals(5000, Fee::getClassroomFee());
    }

    /** @test */
    public function a_special_program_fee_can_be_retrieved()
    {
    	$fee = create('App\Fee',['amount' => 5000, 'item' => 'Special Program']);
    	$this->assertEquals(5000, Fee::getSpecialProgramFee());
    }

    /** @test */
    public function a_handout_fee_can_be_retrieved()
    {
    	$fee = create('App\Fee',['amount' => 5000, 'item' => 'Handout']);
    	$this->assertEquals(5000, Fee::getHandoutFee());
    }
}
