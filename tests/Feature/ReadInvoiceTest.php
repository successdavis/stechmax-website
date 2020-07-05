<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadInvoiceTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function total_amount_of_open_invoices_on_a_user_can_be_checked()
    {
        $user = $this->signIn(factory('App\User')->states('administrator')->create());
        $course = create('App\Course',['amount' => 500000]);
        $courseTwo = create('App\Course',['amount' => 1000000]);
        $course->createInvoice();
        $courseTwo->createInvoice();
        
        $this->assertEquals('15,000.00', auth()->user()->getTotalAmountOfOpenInvoices()); 
    }
}
