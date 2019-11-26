<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PaymentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function payment_can_be_recorded_for_an_invoice()
    {
    	$user = $this->signIn(factory('App\User')->states('administrator')->create());
   		$course = create('App\Course');
   		$invoice = $course->createInvoice();
   		
   		$data = [];
   		$data['amount'] = $course->amount;
   		$data['metadata']['method'] = 'Office';
   		$data['metadata']['purpose'] = 'course payment';
   		$data['reference'] = '7343ffe89';

   		$invoice->recordPayment($data);

   		$this->assertCount(1, $invoice->getAllPayments());    
    }

    // /** @test */
    // public function invoice_cannot_recieve_payment_amount_more_than_the_invoice_amount()
    // {
    //   $user = $this->signIn(create('App\User'));
   	// 	$course = create('App\Course');
   	// 	$invoice = $course->createInvoice();

   	// 	$data = [];
    //     $data['amount'] = $course->amount;
    //     $data['metadata']['method'] = 'Office';
    //     $data['metadata']['purpose'] = 'course payment';
    //     $data['reference'] = '7343ffe89';

   	// 	$invoice->recordPayment($data);
    // }

    /** @test */
    public function a_user_can_retrive_total_amount_paid_for_an_invoice()
    {
        $user = $this->signIn(create('App\User'));
   		$course = create('App\Course');
   		$invoice = $course->createInvoice();

   		$data = [];
   		$data['amount'] = $course->amount / 2;
   		$data['method'] = 'Office';
   		$data['purpose'] = 'course payment';
   		$data['transaction_ref'] = '7343ffe89';

   		$invoice->recordPayment($data);
   		$invoice->recordPayment($data);
   		
   		$total = $invoice->totalPayments();

   		$this->assertEquals($course->amount, $total);
    }

    /** @test */
    public function it_sends_an_email_once_payment_is_recieved()
    {
      
    }
}
