<?php

namespace App\Http\Controllers\Admin;

use App\Newsletter;
use App\News;
use App\Mail\NewsletterMailer;
use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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
        $content = Newsletter::first()->content;
        return view('admin.newsletter')->with('content', $content);
    }

    public function getNewsletterToday()
    {
        $news = News::all();
        $content = '<h1>Latest for today</h1>';

        foreach ($news as $this_news) {
            
            if(Carbon::parse($this_news->publish_date)->diffInDays() == 0)
            {
                $content .= "<a href='".url('/article/'.$this_news->id)."'><h2>".$this_news->title."</h2></a>";
            }
        }

        return view('admin.newsletter')->with('content', $content);
    }

    public function getNewsletterFromArticle($id)
    {
        $news = News::find($id);
        $content = "<h1>".$news->title."<h1>";

        if(isset($news->picture))
        {
            $content .= "<img src=".url('images/news/'.$news->picture)."><br>";
        }
        
        $content .= $news->description;
        return view('admin.newsletter')->with('content', $content);
    }

    public function postNewsletter(Request $request)
    {
        if(Newsletter::count())
        {
            $newsletter = Newsletter::first();
            $newsletter->content = $request['content'];
            $newsletter->update();

            $subscribers = Subscriber::where('confirmed', 1)->get();

            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->send(new NewsletterMailer());
            }
            return redirect()->back();
        }
        else
        {
            $newsletter = new Newsletter();
            $newsletter->content = $request['content'];
            $newsletter->save();

            $subscribers = Subscriber::where('confirmed', 1)->get();

            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->send(new NewsletterMailer());
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

    // public function getSendNewsletter()
    // {
    //     $subscribers = Subscriber::where('confirmed', 1)->get();

    //     foreach ($subscribers as $subscriber) {
    //         Mail::to($subscriber->email)->send(new NewsletterMailer());
    //     }
    //     return redirect()->back();
        
    // }
}
