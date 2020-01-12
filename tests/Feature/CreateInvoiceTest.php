<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateInvoiceTest extends TestCase
{
    use DatabaseMigrations;
    
   /** @test */
       public function an_invoice_can_be_created_for_a_course()
       {
       		
         	$user = $this->signIn(factory('App\User')->states('administrator')->create());
         	$course = create('App\Course');

         	$this->assertCount(0, $course->whereInvoicedBy(auth()->user())->get());

  			  $course->createInvoice();

         	$this->assertCount(1, $course->whereInvoicedBy(auth()->user())->get());
       }
}
