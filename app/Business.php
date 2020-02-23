<?php

namespace App;

use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use ModelFunctions;
    
	protected $with = ['pricing'];

	protected $guarded  = [];
    public $pathPrefix  = '/business/';
    public $findWith    =   'slug';
    // public $excerpt    =   ['description', 23];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($business) {
            $business->update(['slug' => $business->name]);
        });
    }
	
    public function pricing()
    {
    	return $this->hasMany(Pricing::class);
    }


    public function getThumbnailPathAttribute($thumbnail)
    {
        if ($thumbnail) {
            return asset('storage/' . $thumbnail);
        }else {
            return asset('storage/business/default.jpg');
        }
    }
}
