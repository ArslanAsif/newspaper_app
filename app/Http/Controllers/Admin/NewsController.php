<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('publish_date', '!=', null)->get();
        return view('admin.manage_news')->with('news', $news);
    }

    public function getUserSubmission()
    {
        $news = News::where('publish_date', null)->get();
        return view('admin.manage_news_submissions')->with('news', $news);
    }

    public function postUserSubmission($id, Request $request)
    {
        $news = News::where('id', $id)->first();

        $news->title = $request['title'];
        $news->update();

        return view('admin.manage_news_submissions')->with('message', 'Edited');
    }

    public function getAddNews()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.create_news')->with('categories', $categories);
    }

    public function postAddNews(Request $request)
    {
        $news = new News();
        $news->user_id = Auth::user()->id;
        $news->title = $request['title'];
        $news->type = $request['type'];
        $news->category_id = $request['category'];
        $news->summary = $request['summary'];
        $news->description = $request['descr'];
        $news->priority = $request['priority'];
        //$news->tag = $request['tags'];

        if(isset($request['latest']))
        {
            if($request['latest'] == 'on')
                $news->latest = 1;
            else
                $news->latest = 0;
        }

        if(isset($request['homepage']))
        {
            if($request['homepage'] == 'on')
                $news->latest = 1;
            else
                $news->latest = 0;
        }

        if(isset($request['spotlight']))
        {
            if($request['spotlight'] == 'on')
                $news->latest = 1;
            else
                $news->latest = 0;
        }

        $img = $request['image-data'];

        //decode the url, because we want to use decoded characters to use explode
        $decoded = urldecode($img);

        //get image extension
        $ext = explode(';', $decoded);
        $ext = explode(':', $ext[0]);
        $ext = array_pop($ext);
        $ext = explode('/', $ext);
        $ext = array_pop($ext);

        //save image in file
        $img_name = "perfil-".time().".".$ext;
        $path = public_path() . "/images/news/" . $img_name;
        $img = substr($img, strpos($img, ",")+1);
        $data = base64_decode($img);
        $success = file_put_contents($path, $data);
        print $success ? $img_name : 'Unable to save the file.';


        $news->picture = $img_name;
        $news->save();

        return redirect()->back();
    }
    
    public function getEditNews()
    {
        return view('admin.create_news');
    }

    public function postEditNews(Request $request)
    {
        return view('admin.create_news');
    }

    public function getDeleteNews()
    {
        return view('admin.manage_news');
    }
}
