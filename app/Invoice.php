<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];
    
    static public function validateInvoice($id)
    {
        return !! static::find($id);
    }

    static public function createInvoice($data)
    {
        return static::create([
            'amount' => $data->fee,
            'user_id' => auth()->user()->id,
            'course_id' => $data->id
        ]);
    }

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }

    public function recordPayment($data)
    {
     return $this->payments()->create([
            'amount' => $data['amount'],
            'method' => $data['metadata']['method'],
            'purpose' => $data['metadata']['purpose'],
            'transaction_ref' => $data['reference']
        ]);
    }

    public function makeValid()
    {
        return $this->update([
            'valid' => true
        ]);
    }
}
