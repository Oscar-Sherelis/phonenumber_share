<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phonenumbers;
use Auth;

class PhonenumbersController extends Controller
{
    //
    public function index () {
        $phonenumbers = phonenumbers::all()->where('user_id', Auth::user()->id);
        return view('phonenumbers', ['phonenumbers' => $phonenumbers]);
    }
}
