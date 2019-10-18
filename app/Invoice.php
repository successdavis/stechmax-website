<?php

namespace App;

use App\Events\PaymentWasAdded;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'amount', 'invoiceNo'];

    protected $casts = [
        'paid' => 'boolean'
    ];

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
        $payment = $this->payments()->create([
            'amount' => '-' . $data['amount'],
            'method' => $data['metadata']['method'],
            'purpose' => $data['metadata']['purpose'],
            'transaction_ref' => $data['reference']
        ]);

        event(new PaymentWasAdded($payment));

        return $payment;
    }

    public function getAllPayments()
    {
        return $this->payments()->get();
    }

    public function totalPayments()
    {
        return $this->payments()->sum('amount');
    }

    public function amountOwed()
    {
        return $this->totalPayments() + $this->amount;
    }

    public function billable()
    {
        return $this->morphTo();
    }

    static public function generateInvoiceNo()
    {
        $record = self::orderBy('id', 'DESC')->first();
        if(! $record) {
            return 'STM-' . date('Y') . '-0001';
        }
        $expInvoiceNo = explode('-', $record->invoiceNo);
        $newNo = $expInvoiceNo['2']+1;

        return 'STM-' .date('Y') . '-' . sprintf('%04d', $record->id +=1);
    }

    public function status()
    {
        if ($this->paid) {
            return 'completed';
        }

        return $this->amountOwed() / 100;
    }

    public function openInvoice()
    {
        $this->paid = false;  

        return $this->save();
    }

    public function closeInvoice()
    {
        $this->paid = true;

        return $this->save();
    }
}
