<?php

namespace App\Inspections;

use Exception;

class InvalidKeywords
{
    protected $keywords = [
        'yahoo customer support', 'sex', 'fuck', 'idiot', 'shit','ashole','penis','toto'
    ];
    
    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new Exception('Your reply contains Invalid Keywords.');    
            }
        }
    }
}
