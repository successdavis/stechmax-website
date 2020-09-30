<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
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

    public function addTestimony($testimony, $rate) {
        $this->testimonials()->create([
            'testimonial' => $testimony,
            'rate' => $rate
        ]);
    }

    public function getImagePathAttribute($image) {
        if ($image) {
            return asset('storage/' . $image);
        }else {
            return asset('storage/clientimages/default.jpg');
        }
    }
}
