<?php

namespace App\Payments;
use Illuminate\Http\Request;

class Payment
{
    public $data = [];

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function generatePayData($course, $invoice = null)
    {
        foreach ($this->request() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$course, $invoice]));
            }
        }

        return $this->data;
    }

    public function request()
    {
        return $this->request->all();
    }
}
