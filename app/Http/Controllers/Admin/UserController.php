<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user=User::where('id', '!=', Auth::user()->id)->get();
        return view('admin.manage_users',['user'=>$user]);
    }

    public function postEditUser()
    {
        return view('admin.manage_users');
    }

    public function getBanUser($id)
    {
        $ban = 0;
        $user = User::where('id', $id)->first();
        if($user->ban == 1)
            $ban = 0;
        else
            $ban = 1;

        $user->ban = $ban;
        $user->update();

        return redirect()->back();
    }
}
