<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'amount', 'invoiceNo'];

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
            'amount' => '-' . $data['amount'],
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
        $record = self::latest()->first();
        if(! $record) {
            return 'STM' . date('Y') . 0001;
        }
        $expInvoiceNo = explode('-', $record->invoiceNo);
        $newNo = $expInvoiceNo['2']+1;

        return 'STM-' .date('Y') . '-' . sprintf('%04d', $record->id+1);
    }

    public function status()
    {
        if ($this->completed) {
            return 'completed';
        }

        return $this->amountOwed() / 100;
    }

    public function openInvoice()
    {
        $this->completed = false;  

        return $this->save();
    }

    public function closeInvoice()
    {
        $this->completed = true;

        return $this->save();
    }
}
