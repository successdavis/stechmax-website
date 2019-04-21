<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Mail\PleaseConfirmYourEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function a_comfirmation_email_is_sent_upon_registration()
    {
        Mail::fake();
        
        $this->post('/register', [
            'f_name' => 'John',
            'l_name' => 'doe',
            'email' => 'john@example.com',
            'gender' => 'male',
            'phone' => '09061260072',
            'password' => 'foobar000',
            'password_confirmation' => 'foobar000'
        ]);

        Mail::assertQueued(PleaseConfirmYourEmail::class);
    }

    /** @test */
    public function user_can_fully_confirm_their_email_addresses()
    {
        Mail::fake();

        $this->post(route('register'), [
            'f_name' => 'John',
            'l_name' => 'doe',
            'email' => 'john@example.com',
            'gender' => 'male',
            'phone' => '09061260072',
            'password' => 'foobar000',
            'password_confirmation' => 'foobar000'
        ]);

        $user = User::where('f_name', 'John')->first();

        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);


        $this->get('/register/confirm?token=' . $user->confirmation_token)
            ->assertRedirect(route('courses'));

        $this->assertTrue($user->fresh()->confirmed);
        $this->assertNull($user->fresh()->confirmation_token);
    }

    /** @test */
    public function confirming_an_invalid_token()
    {
        $this->get(route('register.confirm', ['token' => 'invalid']))
            ->assertRedirect(route('threads'))
            ->assertSessionHas('flash', 'unknown token.');
    }

    /** @test */
    public function a_user_can_resend_their_confirmation_email()
    {
        Mail::fake();
        
        $this->post('/register', [
            'f_name' => 'John',
            'l_name' => 'doe',
            'email' => 'john@example.com',
            'gender' => 'male',
            'phone' => '09061260072',
            'password' => 'foobar000',
            'password_confirmation' => 'foobar000'
        ]);

        Mail::assertQueued(PleaseConfirmYourEmail::class);

        $user = User::where('f_name', 'John')->first();
            
        $this->get('/register/resend');

        Mail::assertQueued(PleaseConfirmYourEmail::class, 2);
    }
}
 
