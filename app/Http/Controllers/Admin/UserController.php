<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $user=User::get();
        return view('admin.manage_users',['user'=>$user]);
    }

    public function postEditUser()
    {
        return view('admin.manage_users');
    }

    public function getDeleteUser()
    {
        return view('admin.manage_users');
    }
}
