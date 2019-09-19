<?php

namespace App\Rules;

use App\AuthValue\CrossCheck;
use Illuminate\Contracts\Validation\Rule;

class EmailOrPhone implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            return ! resolve(CrossCheck::class)->detect($value);
        } catch (\Exception $e) {
            return false;          
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Validation failed';
    }
}
