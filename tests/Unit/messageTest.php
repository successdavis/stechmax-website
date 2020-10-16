<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class messageTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function message_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('messages', [
            'id', "message", "phone", "email"
          ]), 1);
    }

    /** @test */
    public function anyone_can_send_a_message() {
        $message = make('App\Message');

        $this->postJson('/send-a-message',$message->toArray());

        $this->assertDatabaseHas('messages',['message' => $message->message]);
    }
}
