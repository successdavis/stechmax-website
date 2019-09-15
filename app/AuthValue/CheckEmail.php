<?php 

namespace App\AuthValue;

use App\User;
use Exception;

class CheckEmail
{
	public function check($value)
	{
		if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("You have provided an Invalid Email Address");
		}
		if (User::where('email', $value)->exists()) {
            throw new \Exception("Email Already in use");
		}
	}
}