<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitCardDetails extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'signature';
    }

    static public function saveCardDetails($authorization)
    {
        $card = new Self();
        $card->authorization_code = $authorization['authorization_code'];
        $card->card_type    = $authorization['card_type'];
        $card->last4        = $authorization['last4'];
        $card->exp_month    = $authorization['exp_month'];
        $card->exp_year     = $authorization['exp_year'];
        $card->bin          = $authorization['bin'];
        $card->bank         = $authorization['bank'];
        $card->signature    = $authorization['signature'];
        $card->user_id      = auth()->user()->id;

        $card->save();

        return $card;
    }

    static public function findCard($signature)
    {
        return self::whereSignature($signature);
    }
}
