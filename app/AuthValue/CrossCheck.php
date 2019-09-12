<?php 

namespace App\AuthValue;

class CrossCheck 
{
	// protected $checks = [
	// 	CheckEmail::class
	// ];

	public function detect($value)
	{
		if (ctype_digit($value)) {
			resolve(CheckPhone::class)->check($value);
		}else{
			resolve(CheckEmail::class)->check($value);
		}

		
		return false;
	}
}