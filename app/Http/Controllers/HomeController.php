<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeMailer;
use App\About;
use App\User;
use App\Category;
use App\Comment;
use App\Subscriber;
use Illuminate\Http\Request;
use App\News;
use App\Tag;
use App\Advertisement;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application Landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headlines = News::where('publish_date', '!=', null)->where('latest', 1)->orderBy('created_at', 'DESC')->orderBy('category_id', 'ASC')->take(10)->get();

        $main_spotlight = News::where('publish_date', '!=', null)->where('latest', 1)->where('homepage', 1)->where('spotlight', 1)->orderBy('created_at', 'DESC')->first();
        $main_latest = News::where('publish_date', '!=', null)->where('latest', 1)->where('homepage', 1)->where('spotlight','!=', 1)->orderBy('created_at', 'DESC')->take(3)->get();

        $opinions = News::where('publish_date', '!=', null)->where('type', 'column')->orderBy('created_at', 'DESC')->orderBy('priority', 'ASC')->take(4)->get();

        $category_wise = Category::where('active', 1)->where('homepage', 1)->orderBy('priority', 'ASC')->get();

        $advertisements = Advertisement::where('published_on', '!=', null)->get();

        return view('welcome')->with(['headlines'=>$headlines ,'main_spotlight' => $main_spotlight, 'main_latest' => $main_latest, 'opinions'=>$opinions, 'category_wise' => $category_wise, 'advertisements'=>$advertisements]);
    }

    public function category($type, $id)
    {
        $articles = News::where('category_id', $id)->where('type', $type)->orderBy('created_at', 'DESC')->where('publish_date', '!=', null)->paginate(12);
        $category = Category::where('id', $id)->first()->name;

        $subcategories = Category::where('category_id', $id)->where('active', 1)->get();

        return view('category')->with(['category' => $category, 'articles' => $articles, 'subcategories'=>$subcategories]);
    }

    public function article($id)
    {
        $article = News::where('id', $id)->first();
        $comment_count = $article->comments()->count();
        $advertisements = Advertisement::where('published_on', '!=', null)->get();

        if($article->type == 'news')
        {
            $related = News::where('publish_date', '!=', null)->where('category_id', $article->category_id)->where('type', 'news')->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
            $latest = News::where('publish_date', '!=', null)->where('type', 'news')->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
        }
        else if($article->type == 'column')
        {
            $related = News::where('publish_date', '!=', null)->where('type', 'column')->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
            $latest = News::where('publish_date', '!=', null)->where('type', 'column')->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
        }
        else if($article->type == 'article')
        {
            $related = News::where('publish_date', '!=', null)->where('type', 'article')->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
            $latest = News::where('publish_date', '!=', null)->where('type', 'article')->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
        }
        
        

        return view('article')->with(['article' => $article, 'comment_count' => $comment_count, 'related' => $related, 'latest' => $latest, 'advertisements'=>$advertisements]);
    }

    public function post_comment(Request $request, $id)
    {
        $comment = new Comment();
        $comment->comment = $request['comment'];
        $comment->news_id = $id;
        $comment->user_id = $request->user()->id;
        $comment->save();

        return redirect()->back();
    }

    public function getAddSubscriber($email, $token)
    {
        $subscriber = Subscriber::where('email', $email)->where('token', $token);
        $subscriber_count =  $subscriber->count();
        $subscriber = $subscriber->first();
        if($subscriber_count)
        {
            $subscriber->confirmed = 1;
            $subscriber->update();

            return view('confirmation')->with('message', 'Successfully Subscribed to GCC Connect Newsletter!');
        }
        return view('confirmation')->with('message', 'Not subscribed, try again!');
    }

    public function postAddSubscriber(Request $request)
    {
        if(Subscriber::where('email', $request['email'])->count())
        {
            return redirect()->back()->with('message', 'Already Subscribed');
        }

        $token = str_random(50);
        $subscriber = new Subscriber();
        $subscriber->email = $request['email'];
        $subscriber->token = $token;

        Mail::to($request['email'])->send(new SubscribeMailer($request['email'], $token));
        $subscriber->save();

        return redirect()->back()->with('message', 'Successfully Added! Please check your email to confirm');
    }

    public function getColumns()
    {
        $authors = News::select('user_id')->where('type', 'column')->groupBy('user_id')->get();
        $columns = News::where('type', 'column')->orderBy('created_at', 'DESC')->paginate(12);

        return view('category')->with(['category'=>'Columns', 'authors'=>$authors, 'articles'=>$columns]);
    }

    public function getUserColumns($id)
    {
        $authors = News::select('user_id')->where('type', 'column')->groupBy('user_id')->get();
        $columns = News::where('type', 'column')->where('user_id', $id)->orderBy('created_at', 'DESC')->paginate(12);
        return view('category')->with(['category'=>'Columns', 'articles'=>$columns, 'user'=>User::where('id', $id)->first(), 'authors'=>$authors]);
    }

    public function getMedia()
    {
        $articles = News::where('publish_date', '!=', null)->where('type', 'article')->orderBy('created_at', 'DESC')->paginate(12);
        return view('category')->with(['category'=>'Media', 'articles'=>$articles]);
    }

    public function getTag($id)
    {
        $tags = Tag::orderBy('created_at', 'DESC')->get();
        $articles = Tag::where('id', $id)->first()->news()->orderBy('created_at', 'DESC')->paginate(12);
        return view('tags')->with(['tag_name'=>Tag::where('id', $id)->first()->title ,'tags'=>$tags, 'articles'=>$articles]);
    }

    public function userSubmission()
    {
        $categories = Category::where('active', 1)->orderBy('name', 'asc')->get();
        return view('userSubmission')->with('categories', $categories);
    }

    public function postAddNews(Request $request)
    {
        $news = new News();
        $news->user_id = Auth::user()->id;
        $news->title = $request['title'];
        $news->type = $request['type'];
        if($request['category'] != '')
            $news->category_id = $request['category'];
        else
            $news->category_id = null;
        
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

    public function getDeleteComment($article_id, $comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment->delete();
        return redirect()->back();
    }

    public function getAboutUs()
    {
        $about_us = About::where('type', 'aboutus')->first()->description;
        $contact_us = About::where('type', 'contact')->first()->description;
        return view('about')->with(['about_us'=>$about_us, 'contact_us'=>$contact_us]);
    }

    public function getTermsAndCondition()
    {
        $terms = About::where('type', 'terms')->first()->description;
        return view('terms_and_conditions')->with('terms', $terms);
    }
}
