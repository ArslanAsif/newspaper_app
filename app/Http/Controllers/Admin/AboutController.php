<?php

namespace App\Http\Controllers\Admin;

use App\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function getAboutUs()
    {
        $aboutus = About::where('type','aboutus')->first();
        return view('admin.edit_about',['aboutus'=>$aboutus,'check'=>'aboutus']);
    }

    public function postAboutUs(Request $request)
    {
        $aboutus = About::where('type', 'aboutus')->first();
        $aboutus->description = $request['descr'];
        $aboutus->update();

        return redirect()->back();
    }

    public function getContactUs()
    {
        $contact = About::where('type', 'contact')->first();
        return view('admin.edit_about',['aboutus'=>$contact,'check'=>'contact']);
    }

    public function postContactUs(Request $request)
    {
        $about = About::where('type', 'contact')->first();
        $about->description = $request['descr'];
        $about->update();

        return redirect()->back();
    }

    public function getTerms()
    {

       $terms = About::where('type', 'terms')->first();
        return view('admin.edit_about',['aboutus'=>$terms,'check'=>'terms']);
    }

    public function postTerms(Request $request)
    {
        $terms = About::where('type', 'terms')->first();
        $terms->description = $request['descr'];
        $terms->update();

        return redirect()->back();
    }
}
