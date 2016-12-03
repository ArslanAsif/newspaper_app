<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Two\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Illuminate\Hashing\HashServiceProvider;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function postChangePassword(Request $request)
    {

        $this->validate($request, [
            'curr_pass' => 'required',
            'new-pass' => 'required',
            're-new-pass' => 'required',
        ]);
        $id=Auth::User()->id;
         //Hash::make('test');

        $user = \App\User::find($id);
        $user->password= bcrypt($request['new-pass']);
       if($user->save()){
           return redirect()->back();
       }
        else
        {
            return redirect()->back();
        }
    }
}
