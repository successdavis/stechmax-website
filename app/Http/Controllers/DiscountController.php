<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DiscountController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'discount'  => 'required|integer'
        ]);

        return DB::table('courses')->update(array('discount_percentage' => $request->discount));
    }
}
