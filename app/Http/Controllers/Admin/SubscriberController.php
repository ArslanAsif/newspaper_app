<?php

namespace App\Http\Controllers\Admin;

use App\Newsletter;
use App\Mail\NewsletterMailer;
use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function index()
    {
        $subcribe=Subscriber::where ('confirmed','1')->get();
        return view('admin.subscribers',['subcribe'=>$subcribe]);
    }
    public function deleteSubscriber($id)
    {
        $subcribe = Subscriber::where('id', $id)->first();
        if($subcribe){
            $subcribe->delete();
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
    }

    public function getNewsletter()
    {
        $newsletter = Newsletter::first();
        return view('admin.newsletter')->with('newsletter', $newsletter);
    }

    public function postNewsletter(Request $request)
    {
        if(Newsletter::count())
        {
            $newsletter = Newsletter::first();
            $newsletter->content = $request['content'];
            $newsletter->update();
        }
        else
        {
            $newsletter = new Newsletter();
            $newsletter->content = $request['content'];
            $newsletter->save();
        }
        return redirect()->back();
    }

    public function getSendNewsletter()
    {
        $subscribers = Subscriber::where('confirmed', 1)->get();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMailer());
        }
        return redirect()->back();
        
    }
}
