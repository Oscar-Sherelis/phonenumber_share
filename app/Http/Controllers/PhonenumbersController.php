<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phonenumbers;
use App\Users;
use Auth;

class PhonenumbersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    //
    public function index () {
        $users = Users::all()->where('id', '!=', Auth::user()->id);
        
        $phonenumbers = phonenumbers::all()->where('user_id', Auth::user()->id);
        return view('phonenumbers', ['phonenumbers' => $phonenumbers], ['users' => $users]);
    }

    public function deletePhonenumber (Request $req) {
        phonenumbers::where('id', $req->input('delete'))->delete(); 
    }
}
