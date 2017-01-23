<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Comment;
use App\Subscriber;
use Illuminate\Http\Request;
use App\News;
use App\Tag;
use App\Advertisement;

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
        $headlines = News::where('publish_date', '!=', null)->where('latest', 1)->orderBy('category_id', 'ASC')->orderBy('created_at', 'DESC')->take(10)->get();

        $main_spotlight = News::where('publish_date', '!=', null)->where('latest', 1)->where('spotlight', 1)->orderBy('created_at', 'DESC')->first();
        $main_latest = News::where('publish_date', '!=', null)->where('latest', 1)->where('spotlight','!=', 1)->orderBy('created_at', 'DESC')->take(3)->get();

        $opinions = News::where('publish_date', '!=', null)->where('type', 'column')->orderBy('created_at', 'DESC')->orderBy('priority', 'ASC')->take(4)->get();

        $category_wise = Category::where('active', 1)->where('homepage', 1)->orderBy('priority', 'ASC')->get();

        $advertisements = Advertisement::where('published_on', '!=', null)->get();

        return view('welcome')->with(['headlines'=>$headlines ,'main_spotlight' => $main_spotlight, 'main_latest' => $main_latest, 'opinions'=>$opinions, 'category_wise' => $category_wise, 'advertisements'=>$advertisements]);
    }

    public function category($type, $id)
    {
        $articles = News::where('category_id', $id)->where('type', $type)->orderBy('created_at', 'DESC')->paginate(12);
        $category = Category::where('id', $id)->first()->name;

        $subcategories = Category::where('id', $id)->where('category_id', '!=',  '')->where('active', 1)->get();

        return view('category')->with(['category' => $category, 'articles' => $articles, 'subcategories'=>$subcategories]);
    }

    public function article($id)
    {
        $article = News::where('id', $id)->first();
        $comment_count = $article->comments()->count();
        $advertisements = Advertisement::where('published_on', '!=', null)->get();

        if($article->type == 'news')
        {
            $related = News::where('category_id', $article->category_id)->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
            $latest = News::where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
        }
        else if($article->type == 'column')
        {
            $related = News::where('type', 'column')->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
            $latest = News::where('type', 'column')->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
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

    public function postAddSubscriber(Request $request)
    {
        if(Subscriber::where('email', $request['email'])->count())
        {
            return redirect()->back()->with('message', 'Already Subscribed');
        }

        $subscriber = new Subscriber();
        $subscriber->email = $request['email'];
        $subscriber->token = str_random(50);
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
        $articles = News::where('type', 'article')->orderBy('created_at', 'DESC')->paginate(12);
        return view('category')->with(['category'=>'Media', 'articles'=>$articles]);
    }

    public function getTag($id)
    {
        $tags = Tag::orderBy('created_at', 'DESC')->get();
        $articles = Tag::where('id', $id)->first()->news()->orderBy('created_at', 'DESC')->paginate(12);
        return view('tags')->with(['tag_name'=>Tag::where('id', $id)->first()->title ,'tags'=>$tags, 'articles'=>$articles]);
    }
}
