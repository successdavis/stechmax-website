<?php 

namespace App\AuthValue;

use Exception;
/**
 * 
 */
class CheckPhone
{
	public function check($value)
	{
		if (strlen($value) < 11 || strlen($value) > 11) {
			throw new Exception("Phone Number must be 11 digits");	
		}
	}
}