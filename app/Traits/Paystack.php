<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Paystack
{
   public function makePaystackRequest($url = "https://api.paystack.co/transaction/initialize", $fields_string)
   {
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . getenv('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));

          //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

        //execute post
        $result = curl_exec($ch);

        $responds = json_decode($result, true);

        return $responds;
   }

    public function verifyTransaction($reference)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "Authorization: Bearer " . getenv('PAYSTACK_SECRET_KEY'),
              "Cache-Control: no-cache",
          ),
        ));

        $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

        $data = json_decode($response, true);

        if ($err) {
            abort('Something unexpected happened', '500');
        } else {
            if (isset($data['data'])) {
                if ($data['data']['status'] === "success") {
                    return $data;
                }
                return false;
            }
            return false;
        }
    }
}
