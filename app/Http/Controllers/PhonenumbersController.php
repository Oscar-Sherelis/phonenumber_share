<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phonenumbers;
use App\phonenumber_share;
use App\Users;
use Auth;
use Illuminate\Support\Facades\DB;

class PhonenumbersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    //
    public function index () {
        $users = Users::all()->where('id', '!=', Auth::user()->id);
        $phonenumbers = phonenumbers::all()->where('user_id', Auth::user()->id);
        
        $shared = DB::table('phonenumber_shares')
        ->join('phonenumbers', 'phonenumber_shares.number_id', '=', 'phonenumbers.id')
        ->join('users', 'phonenumber_shares.user_from_id', '=', 'users.id')
        ->select('users.name', 'phonenumbers.phonenumber', 'phonenumbers.id')
        ->where('phonenumber_shares.user_id', '=', Auth::user()->id)
        ->get();

        return view('phonenumbers', compact('phonenumbers', 'users', 'shared'));
    }

    public function deletePhonenumber (Request $req) {
        $req->validate([
            'delete' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/'
        ]);
        phonenumbers::where('id', $req->input('delete'))->delete();
        return redirect('/phonenumbers')->with('success', 'Number deleted successfully');
    }

    public function addPhonenumber (Request $req) {
        $req->validate([
            'add' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/| min:9 | max:12'
        ]);
        // $checkNumberExists = phonenumbers::select('id')->where('phonenumber', $req->input('add'))->exists();
        if (!phonenumbers::where('phonenumber', $req->input('add'))->exists()) {
            $phonenumbers = new phonenumbers();
            $phonenumbers->phonenumber = $req->input('add');
            $phonenumbers->user_id = Auth::user()->id;
            $phonenumbers->save();
            return redirect()->back()->with('success', 'new number added successfully');  
        } else {
            print '<h2>Phonenumber already exists</h2>
            <a href=\'/phonenumbers\'>Back to home page</a>';
        } 
    }

    public function getPhone () {
        $phone_id = request('edit');
        $phonenumber = phonenumbers::all()->where('id', $phone_id);
        return view('edit_phone', ['phonenumber' => $phonenumber]);
    }
    public function editPhonenumber (Request $req) {
        $req->validate([
            'change' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',
            'new_number' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/ | min:9 | max:12'
        ]);
        phonenumbers::where('id', $req->input('change'))
            ->update(array('phonenumber' => $req->input('new_number')));
            // ->save();
        return redirect('/phonenumbers')->with('success', 'Number updated successfully');  
    }
}