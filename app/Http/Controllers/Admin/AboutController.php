<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Cache;

use App\About;
use App\Link;
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
        $aboutus = About::where('type', 'aboutus');
        if($aboutus->count() > 0)
        {
            $aboutus = $aboutus->first();
            $aboutus->description = $request['descr'];
            $aboutus->update();
        }
        else
        {
            $aboutus = new About();
            $aboutus->type = 'aboutus';
            $aboutus->description = $request['descr'];
            $aboutus->save();
        }

        return redirect()->back();
    }

    public function getAboutGcc()
    {
        $aboutus = About::where('type','aboutgcc')->first();
        return view('admin.edit_about',['aboutus'=>$aboutus,'check'=>'aboutgcc']);
    }

    public function postAboutGcc(Request $request)
    {
        $aboutgcc = About::where('type', 'aboutgcc');
        if($aboutgcc->count() > 0)
        {
            $aboutgcc = $aboutgcc->first();
            $aboutgcc->description = $request['descr'];
            $aboutgcc->update();
        }
        else
        {
            $aboutgcc = new About();
            $aboutgcc->type = 'aboutgcc';
            $aboutgcc->description = $request['descr'];
            $aboutgcc->save();
        }

        return redirect()->back();
    }

    public function getContactUs()
    {
        $contact = About::where('type', 'contact')->first();
        return view('admin.edit_about',['aboutus'=>$contact,'check'=>'contact']);
    }

    public function postContactUs(Request $request)
    {
        $contact = About::where('type', 'contact');
        if($contact->count() > 0)
        {
            $contact = $contact->first();
            $contact->description = $request['descr'];
            $contact->update();
        }
        else
        {
            $contact = new About();
            $contact->type = 'contact';
            $contact->description = $request['descr'];
            $contact->save();
        }

        return redirect()->back();
    }

    public function getTerms()
    {

       $terms = About::where('type', 'terms')->first();
        return view('admin.edit_about',['aboutus'=>$terms,'check'=>'terms']);
    }

    public function postTerms(Request $request)
    {
        $terms = About::where('type', 'terms');
        if($terms->count() > 0)
        {
            $terms = $terms->first();
            $terms->description = $request['descr'];
            $terms->update();
        }
        else
        {
            $terms = new About();
            $terms->type = 'terms';
            $terms->description = $request['descr'];
            $terms->save();
        }

        return redirect()->back();
    }

    public function getLinks($country)
    {
        $links = About::where('type', 'links')->where('country', $country)->first();
        return view('admin.edit_about',['aboutus'=>$links,'check'=>'links', 'country'=>$country]);
    }

    public function postLinks(Request $request)
    {
        $links = About::where('type', 'links')->where('country', $request['country']);
        if($links->count() > 0)
        {
            $links = $links->first();
            $links->description = $request['descr'];
            $links->update();
        }
        else
        {
            $links = new About();
            $links->country = $request['country'];
            $links->type = 'links';
            $links->description = $request['descr'];
            $links->save();
        }
        
        return redirect()->back();
    }
}
