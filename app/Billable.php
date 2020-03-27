<?php

namespace App;

trait Billable
{
    public function invoices ()
    {
        return $this->morphMany(Invoice::class, 'billable');
    }

//    get all courses with an invoice by this user
    public function scopeWhereInvoicedBy($query, User $user)
    {
        return $query->whereHas('invoices', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

//  Get all invoices for this user only on a specified mode i.e. not all of the users invoices 
//  but only the ones related to a specific course or other payments.
    public function InvoicesOnItemByUsers(user $user)
    {
        return $this->invoices()->where('user_id', $user->id);
    }

//  to create invoice for a user in a particular module e.g. $course->createInvoice(1);
    public function createInvoice($userId = null, $installmental = null, $charge = null)
    {
        return $this->invoices()->save(
            new Invoice([
                'user_id' => $userId ?: auth()->id(),
                'amount' => $this->amount + $charge,
                'invoiceNo' => Invoice::generateInvoiceNo(),
                'installmental' => $installmental ?: true,
            ])
        );
    }
}