<?php

namespace App;

trait Billable
{
    public function invoices ()
    {
        return $this->morphMany(Invoice::class, 'billable');
    }

//    get all courses invoice by this user
    public function scopeWhereInvoicedBy($query, User $user)
    {
        return $query->whereHas('invoices', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

//    to create invoice for a user in a particular module e.g. $course->createInvoice(1);
    public function createInvoice($userId = null)
    {
        return $this->invoices()->save(
            new Invoice([
                'user_id' => $userId ?: auth()->id(),
                'amount' => $this->amount,
            ])
        );
    }
}