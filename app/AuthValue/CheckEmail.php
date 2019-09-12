<?php 

namespace App\AuthValue;

use Exception;

class CheckEmail
{
	public function check($value)
	{
		if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("You have provided an Invalid Email Address");
		}
	}
}