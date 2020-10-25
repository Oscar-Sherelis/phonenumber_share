<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phonenumbers;

class EditPhoneController extends Controller
{
    public function index () {
        $phone_id = request('phone');
        $phonenumber = phonenumbers::all()->where('id', $phone_id);
        // var_dump($phonenumber);
        return view('edit_phone', ['phonenumber' => $phonenumber]);
    }
}
