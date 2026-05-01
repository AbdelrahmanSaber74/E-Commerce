<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CurrencyController extends Controller
{
    public function switch(Request $request)
    {
        $currency = $request->input('currency', 'EGP');
        Session::put('currency', $currency);
        
        return back()->with('success', 'Currency switched to ' . $currency);
    }
}
