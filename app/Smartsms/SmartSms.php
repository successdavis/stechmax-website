<?php


namespace App\SmartSms;
use Zttp\Zttp;

/**
 */
class SmartSms
{
	protected $token;
	
	protected $sender 	=	'STECHMAX';

	protected $baseUrl 	= 	'https://smartsmssolutions.com/api/json.php';

	function __construct($token = null)
	{
		if ($token) {
			$this->token = $token;
		}else {
			$this->token = config('services.smartsms.token');
		}
	}

	public function message($to, $message, $sender)
	{
		$response = Zttp::asFormParams()->post($this->baseUrl, [
            'token' 	=> $this->token,
            'sender' 	=> $sender,
            'to' 		=> $to,
            'type' 		=> '0',
            'routing' 	=> 4,
            'message' 	=> $message
        ]);

        if ($response->json()['code'] === "1000") {
        	return true;
        }

        return false;
	}
}