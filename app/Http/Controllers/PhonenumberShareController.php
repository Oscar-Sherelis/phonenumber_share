<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phonenumbers;
use App\Users;
use App\phonenumber_share;
use Auth;

class PhonenumberShareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function shareNumber(Request $req)
    {
        $req->validate([
            'shared_user' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',
            'phonenumber_list' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/'
        ]);

        $phoneId = $req->input('phonenumber_list');
        $userId = $req->input('shared_user');

        // check if exists in shared table
        $checkInShare = phonenumber_share::where([
            ['user_id', '=', $userId],
            ['number_id', '=', $phoneId]
        ])->count();

         // check in phonenumbers if exists in phonenumbers table
        $phone = phonenumbers::where('id', '=', $phoneId)->first();
        $checkInPhonenumbers = phonenumbers::where([
            ['phonenumber', '=', $phone->phonenumber],
            ['user_id', '=', $userId]
        ])->count();

        // if no user has already shared same number and user not has already this phone then ok
        if ($checkInShare == 0 && $checkInPhonenumbers == 0) {
            $sharedPhonenumbers = new phonenumber_share();
            $sharedPhonenumbers->user_id = $userId;
            $sharedPhonenumbers->number_id = $phoneId;
            $sharedPhonenumbers->user_from_id = Auth::user()->id;
            $sharedPhonenumbers->save();
            return redirect()->back()->with('success', 'Number shared successfully');
        }
        print 'User already have this phone number';
    }
    public function addShared (Request $req) {
        $req->validate([
            'shared_number_id' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);
    
        // check if user already has phone
        if (phonenumbers::where([
            ['id', '=', $req->input('shared_number_id')],
            ['user_id', '=', Auth::user()->id]
        ])->count() == 0) {
            
            $phone = phonenumbers::where('id', '=', $req->input('shared_number_id'))->first();
            $phonenumbers = new phonenumbers();
            $phonenumbers->phonenumber =  $phone->phonenumber;
            $phonenumbers->user_id = Auth::user()->id;
            $phonenumbers->save();
            phonenumber_share::where('number_id', $req->input('shared_number_id'))->delete();

        return redirect()->back()->with('success', 'new number added successfully');
        } else {
            print 'User already has this phonenumber';
        }
    }

    public function rejectShared (Request $req) {
        $req->validate([
            'shared_number_id' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);

        phonenumber_share::where('number_id', $req->input('shared_number_id'))->delete();
        return redirect()->back()->with('success', 'Shared number was rejected successfully');
    }
}