<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'amount'];

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public function getAllPayments()
    {
        return $this->payments()->get();
    }

    public function totalPayments()
    {
        return $this->payments()->sum('amount');
    }
}
