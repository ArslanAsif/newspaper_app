<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\News;
use App\Tag;
use Carbon\Carbon;
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

        if(isset($request['homepage']) && isset($request['latest']) && isset($request['spotlight']))
        {
            $checking = News::where('homepage', 1)->where('spotlight', 1)->where('latest', 1)->get();
            foreach($checking as $check)
            {
                $check->spotlight = 0;
                $check->update();
            }
        }

        if(isset($request['latest']))
        {
            $news->latest = 1;
        }

        if(isset($request['homepage']))
        {
            $news->homepage = 1;
        }
        else
            $news->homepage = 0;

        if(isset($request['spotlight']))
        {
            $news->spotlight = 1;
        }
        else
            $news->spotlight = 0;

        if(isset($request['publish']))
        {
            $news->publish_date = Carbon::now();
        }
        else
            $news->publish_date = null;

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

        $error = '';
        $success ? $news->picture = $img_name : $error = 'Unable to save cover image';


        $news->save();

        $tags = explode(',', $request['tags']);
        foreach($tags as $tag)
        {
            $tag_id = Tag::where('title', $tag)->first();
            if(!isset($tag_id->id))
            {
                $tag_id = new Tag();
                $tag_id->title = $tag;
                $tag_id->save();
            }
            $news->tags()->attach($tag_id);
        }

        return redirect()->back()->with(['message' => 'Successfully Submitted', 'error' => $error]);
    }
    
    public function getEditNews($id)
    {
        $news = News::where('id', $id)->with('tags')->first();
        $categories = Category::orderBy('name', 'asc')->get();

        $array = '';
        foreach($news->tags as $tag)
        {
            if($array != '')
            {
                $array = $array.", ".$tag->title;
            }
            else
            {
                $array = $array.$tag->title;
            }
        }

        return view('admin.create_news')->with(['news' => $news, 'categories' => $categories, 'tags' => $array]);
    }

    public function postEditNews($id, Request $request)
    {
//        return $request->all();

        $news = News::where('id', $id)->first();

        $news->user_id = $request->user()->id;
        $news->title = $request['title'];
        $news->type = $request['type'];
        $news->category_id = $request['category'];
        $news->summary = $request['summary'];
        $news->description = $request['descr'];
        $news->priority = $request['priority'];

        if(isset($request['latest']))
        {
            $news->latest = 1;
        }
        else
            $news->latest = 0;

        if(isset($request['homepage']))
        {
            $news->homepage = 1;
        }
        else
            $news->homepage = 0;

        if(isset($request['spotlight']))
        {
            $news->spotlight = 1;
        }
        else
            $news->spotlight = 0;

        if(isset($request['publish']))
        {
            $news->publish_date = Carbon::now();
        }
        else
            $news->publish_date = null;

        if(isset($request['image-data']))
        {
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

            $error = '';
            $success ? $news->picture = $img_name : $error = 'Unable to save cover image';
        }

        $news->update();

        $tags = explode(',', $request['tags']);
        $news->tags()->detach();

        foreach($tags as $tag)
        {
            $tag_id = Tag::where('title', $tag)->first();
            if(!isset($tag_id->id))
            {
                $tag_id = new Tag();
                $tag_id->title = $tag;
                $tag_id->save();
            }

            $news->tags()->attach($tag_id);
        }

        return redirect()->back();
    }

    public function getDeleteNews($id)
    {
        $news = News::where('id', $id)->first();
        $news->delete();
        return back();
    }
}
