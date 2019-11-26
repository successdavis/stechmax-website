<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InvoiceTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function retrieve_all_invoices_for_a_user()
    {
   		$user = $this->signIn(factory('App\User')->states('administrator')->create());
   		$course = create('App\Course');
   		$courseTwo = create('App\Course');
		$course->createInvoice();
		$courseTwo->createInvoice();

   		$this->assertCount(2, $course->whereInvoicedBy(auth()->user())->get());   
    }

    /** @test */
    public function all_invoices_can_be_retrieved_for_a_specified_item_and_for_a_specific_user()
    {
    	$user = $this->signIn(factory('App\User')->states('administrator')->create());
    	$userTwo = create('App\User');

   		$course = create('App\Course');
		$course->createInvoice();
		$course->createInvoice();
		$course->createInvoice($userTwo->id);

   		$courseTwo = create('App\Course');
		$courseTwo->createInvoice();

   		$this->assertCount(2, $course->InvoicesOnItemByUsers(auth()->user())->get());   
        
    }

    /** @test */
    public function it_can_determine_its_owner()
    {
    	$user = $this->signIn(create('App\User'));
   		$course = create('App\Course');
		$invoice = $course->createInvoice();
        
        $this->assertInstanceOf('App\User', $invoice->owner);

    }

    /** @test */
    public function an_invoice_id_is_generated_for_a_new_invoice()
    {
        $user = $this->signIn(create('App\User'));
        $invoice = create('App\Invoice');
        $invoiceNo = $invoice->generateInvoiceNo();
        $this->assertEquals($invoiceNo, 'STM-2019-0002');
    }

    /** @test */
    public function an_invoice_can_determine_its_status()
    {
        $user = $this->signIn(create('App\User'));
        $invoice = create('App\Invoice');
        $this->assertEquals($invoice->status(), $invoice->amount / 100);
        $invoice->closeInvoice();
        $this->assertEquals($invoice->status(), 'completed');
    }

    /** @test */
    public function an_invoice_can_be_closed()
    {
        $user = $this->signIn(create('App\User'));
        $invoice = create('App\Invoice');
        $invoice->closeInvoice();
        $this->assertTrue($invoice->paid);
    }

    /** @test */
    public function an_invoice_can_be_open()
    {
        $user = $this->signIn(create('App\User'));
        $invoice = create('App\Invoice');
        $invoice->closeInvoice();
+        $this->assertTrue($invoice->paid);
        $invoice->openInvoice();
+        $this->assertFalse($invoice->paid);
    }

    /** @test */
    public function an_invoice_is_auto_close_once_it_has_recieved_full_payment()
    {
        $user = $this->signIn(create('App\User'));
        $invoice = create('App\Invoice');

        $data = [];
        $data['amount'] = $invoice->amount;
        $data['metadata']['method'] = 'Office';
        $data['metadata']['purpose'] = 'course payment';
        $data['reference'] = '7343ffe89';

        $invoice->recordPayment($data);
+        $this->assertTrue($invoice->fresh()->paid);
    }
}
