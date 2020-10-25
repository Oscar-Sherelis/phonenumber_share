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
        $req->validate([
            'delete' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/'
        ]);
        phonenumbers::where('id', $req->input('delete'))->delete(); 
    }

    public function addPhonenumber (Request $req) {
        $req->validate([
            'add' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/|min:9'
        ]);
        $phonenumbers = new phonenumbers();
        $checkNumberExists = phonenumbers::select('id')->where('phonenumber', $req->input('add'))->exists();
        if (!phonenumbers::where('phonenumber', $req->input('add'))->exists()) {
            $phonenumbers->phonenumber = $req->input('add');
            $phonenumbers->user_id = Auth::user()->id;
            $phonenumbers->save();
            return redirect()->back()->with('success', 'new number added successfully');  
        } else {
            echo 'Phonenumber already exists';
        } 
    }

    public function getPhone () {
        $phone_id = request('edit');
        $phonenumber = phonenumbers::all()->where('id', $phone_id);
        return view('edit_phone', ['phonenumber' => $phonenumber]);
    }
    public function editPhonenumber (Request $req) {
        $req->validate([
            'change' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/'
        ]);
        phonenumbers::where('id', $req->input('change'))
            ->update(array('phonenumber' => $req->input('new_number')));
            // ->save();
        return redirect('/phonenumbers')->with('success', 'Number updated successfully');  
    }
}
