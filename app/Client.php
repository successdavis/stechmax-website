<?php

namespace App;

use App\Traits\Hastags;
use App\Traits\NewsDispatcher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Client extends Model
{
    use NewsDispatcher, Hastags;

    protected $fillable = ['image_path'];
    public function testimonials() {
        return $this->hasMany(clienttestimonial::class);
    }

    public function generateTestimonialToken(){

        do {
            $token = str_random(15);
        } while ( self::where('testimonial_token', $token)->exists());

        $this->testimonial_token = $token;

        $this->save();
        return true;
    }

    public function deleteToken() {
        $this->testimonial_token = '';
        $this->save();
    }

    public function addTestimony($testimony, $rate) {
        return $this->testimonials()->create([
            'testimonial'           => request('testimonial'),
            'recommendation_rate'   => request('recommendation_rate'),
            'satisfaction_rate'     => request('satisfaction_rate'),
            'suggestion'            => request('suggestion'),
        ]);
    }

    public function getImagePathAttribute($image) {
        if ($image) {
            return asset('storage/' . $image);
        }else {
            return asset('storage/clientimages/default.png');
        }
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
