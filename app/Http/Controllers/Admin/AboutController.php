<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function getAboutUs()
    {
        return view('admin.edit_about');
    }

    public function postAboutUs()
    {
        return view('admin.edit_about');
    }

    public function getContactUs()
    {
        return view('admin.edit_about');
    }

    public function postContactUs()
    {
        return view('admin.edit_about');
    }

    public function getTerms()
    {
        return view('admin.edit_about');
    }

    public function postTerms()
    {
        return view('admin.edit_about');
    }
}
