<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertisementController extends Controller
{
    public function index()
    {
        return view('admin.manage_advertisements');
    }

    public function getAddAdvertisement()
    {
        return view('admin.create_advertisement');
    }

    public function postAddAdvertisement()
    {
        return view('admin.manage_advertisements');
    }

    public function getEditAdvertisement()
    {
        return view('admin.create_advertisement');
    }

    public function postEditAdvertisement()
    {
        return view('admin.create_advertisement');
    }

    public function getDeleteAdvertisement()
    {
        return view('admin.manage_advertisements');
    }
}
