<?php

namespace App\Http\Controllers;

use App\Course;
use App\DebitCardDetails;
use App\Traits\Paystack;
use Illuminate\Http\Request;

class ChildComputerEducationController extends Controller
{
    use Paystack;


    protected $durationsfee = [
        1 => 500000,
        3 => 1200000,
        6 => 1800000
    ];

    protected $durationInWeeks = [
        1 => 4,
        2 => 12,
        6 => 24
    ];

    public function index() {
        return view('dedicatedpages.childcomputereducation');
    }

    public function payment(Request $request) {
        $request->validate([
            'duration'     => 'required|int'
        ]);

        $reference_num = rand(10*45, 100*98);

        $data = [
            "amount" => $this->durationsfee[$request->duration],
            "key" => getenv('PAYSTACK_SECRET_KEY'),
            "email" => auth()->user()->email ? auth()->user()->email : 'support@stechmax.com',
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => getenv('DOMAIN_NAME') . '/childeducationpayment/callback',
            "metadata" => [
                'purpose' => 'Child Education Course Subscription',
                'method' => 'Paystack',
                'course_duration' => $request->duration,
            ],
        ];

        $url = "https://api.paystack.co/transaction/initialize";

        $fields_string = http_build_query($data);

        $responds = $this->makePaystackRequest($url,$fields_string);

        return redirect($responds['data']['authorization_url']);
    }
    
    public function store(Request $request) {
        $paymentDetails = $this->verifyTransaction($request->reference);

        $card = $this->saveCardDetails($paymentDetails['data']['authorization']);

        if (!$paymentDetails) {
            abort(400, 'Invalid Transaction');
        }

        $paymentDetails = $paymentDetails;
        request()->user()->updatePaystackId($paymentDetails['data']['customer']['customer_code']);

        $course = Course::find(80);

        $this->createSubscription($course, $paymentDetails);


        return redirect('/paid/' . $course->slug)
        ->with('flash', 'Payment Successful');
    }

    public function createSubscription($course, $paymentDetails) {

        $duration = $paymentDetails['data']['metadata']['course_duration'];

        $invoice = $course->createInvoice('','', '', $paymentDetails['data']['amount']);

        $invoice->recordPayment($paymentDetails['data']);

        return $course->createSubscription('', $invoice->id, $class = true, $duration = $this->durationInWeeks[$duration]);
    }

    public function saveCardDetails($cardDetails)
    {

        if (DebitCardDetails::findCard($cardDetails['signature'])->get()->isEmpty()) {
            $card = DebitCardDetails::saveCardDetails($cardDetails);

            return $card;
        }
        
        $card = DebitCardDetails::findCard($cardDetails['signature']);
        return $card;
    }
}
