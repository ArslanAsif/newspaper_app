<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function postChangePassword(Request $request)
    {
        return view('admin.settings');
    }
}
