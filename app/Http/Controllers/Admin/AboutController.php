<?php

namespace App\Http\Controllers\Admin;

use App\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function getAboutUs()
    {
        $aboutus=About::where('id',1)->where('type','About')->get();
        return view('admin.edit_about',['aboutus'=>$aboutus,'check'=>'/admin/about/aboutus']);
    }

    public function postAboutUs(Request $request)
    {
        $about = About::find(1);
        $about->description=$request['descr'];
        if($about->save()){
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
    }

    public function getContactUs()
    {
        $contactus=About::where('id',2)->where('type','contactus ')->get();
        return view('admin.edit_about',['aboutus'=>$contactus,'check'=>'/admin/about/contact']);
    }

    public function postContactUs(Request $request)
    {
        $about = About::find(2);
        $about->description=$request['descr'];
        if($about->save()){
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
    }

    public function getTerms()
    {

       $terms=About::where('id',3)->where('type','terms ')->get();
        return view('admin.edit_about',['aboutus'=>$terms,'check'=>'/admin/about/terms']);
    }

    public function postTerms(Request $request)
    {
        $terms = About::find(3);
        $terms->description=$request['descr'];
        if($terms->save()){
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }    }
}
