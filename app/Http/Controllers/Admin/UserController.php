<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.manage_users');
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
