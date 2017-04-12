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
use Illuminate\Support\Facades\Cache;

use Illuminate\Contracts\Validation\Validator;

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

    public function getClearCountry()
    {
        Cache::forget('country');
        Cache::forget('city');

        return redirect('/');
    }

    public function getSetCountry($country)
    {
        switch(strtoupper($country))
        {
            case "BH": 
            {
                $country = "Bahrain";
                $city = "Manama";
                break;
            }

            case "KW": {
                $country = "Kuwait";
                $city = "Kuwait City";
                break;
            }

            case "OM": {
                $country = "Oman";
                $city = "Muscat";
                break;
            }

            case "QA": {
                $country = "Qatar";
                $city = "Doha";
                break;
            }

            case "SA": {
                $country = "Saudi Arabia";
                $city = "Riyadh";
                break;
            }

            case "AE": {
                $country = "UAE";
                $city = "Dubai";
                break;
            }

            // default: {
            //     $country = "Saudi Arabia";
            // }
        }

        Cache::put('country', $country, 60);
        Cache::put('city', $city, 60);
        return back();
    }

    public function index()
    {   
        // //$ip = $_SERVER['REMOTE_ADDR'];
        // $ip = "119.155.54.186"; //demo ip remove when deploy
        // $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        // $city = $details->city;
        // Cache::put('city', $city, 60*24*7);

        if(Cache::has('country'))
        {
            $coun = Cache::get('country');
            $city = Cache::get('city');
        }

        $headlines = News::where('publish_date', '!=', null)->where('latest', 1)->orderBy('publish_date', 'DESC')->take(10)->get();


        if(Cache::has('country'))
        {
            $main_spotlight = News::where('country', $coun)->where('publish_date', '!=', null)->where('latest', 1)->where('homepage', 1)->where('spotlight', 1)->orderBy('publish_date', 'DESC')->first();
            $main_latest = News::where('country', $coun)->where('publish_date', '!=', null)->where('latest', 1)->where('homepage', 1)->where('spotlight','!=', 1)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->take(6)->get();
            $main_latest_count = News::where('country', $coun)->where('publish_date', '!=', null)->where('latest', 1)->where('homepage', 1)->where('spotlight','!=', 1)->take(6)->count();
        }
        else
        {
            $main_spotlight = News::where('publish_date', '!=', null)->where('latest', 1)->where('homepage', 1)->where('spotlight', 1)->orderBy('publish_date', 'DESC')->first();
            $main_latest = News::where('publish_date', '!=', null)->where('latest', 1)->where('homepage', 1)->where('spotlight','!=', 1)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->take(6)->get();
            $main_latest_count = News::where('publish_date', '!=', null)->where('latest', 1)->where('homepage', 1)->where('spotlight','!=', 1)->take(6)->count();
        }

        

        $opinions = News::where('publish_date', '!=', null)->where('category', 'Opinion')->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->take(4)->get();

        $category_gcc_spotlight = News::where('category', 'GCC')->where('publish_date', '!=', null)->where('spotlight', 1)->first();

        $category_gcc = News::where('category', 'GCC')->where('publish_date', '!=', null)->where('spotlight', '!=', 1)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->take(4)->get();

        $category_world_spotlight = News::where('category', 'World')->where('publish_date', '!=', null)->where('spotlight', 1)->first();
        $category_world = News::where('category', 'World')->where('publish_date', '!=', null)->where('spotlight', '!=', 1)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->take(4)->get();
        $category_business_spotlight = News::where('category', 'Business')->where('publish_date', '!=', null)->where('spotlight', 1)->first();
        $category_business = News::where('category', 'Business')->where('publish_date', '!=', null)->where('spotlight', '!=', 1)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->take(4)->get();
        $category_weather_spotlight = News::where('category', 'Weather')->where('publish_date', '!=', null)->where('spotlight', 1)->first();
        $category_weather =  News::where('category', 'Weather')->where('publish_date', '!=', null)->where('spotlight', '!=', 1)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->take(4)->get();
        $category_sports_spotlight = News::where('category', 'Sports')->where('publish_date', '!=', null)->where('spotlight', 1)->first();
        $category_sports = News::where('category', 'Sports')->where('publish_date', '!=', null)->where('spotlight', '!=', 1)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->take(4)->get();
        $category_lifestyle_spotlight = News::where('category', 'Lifestyle')->where('publish_date', '!=', null)->where('spotlight', 1)->first();
        $category_lifestyle = News::where('category', 'Lifestyle')->where('publish_date', '!=', null)->where('spotlight', '!=', 1)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->take(4)->get();

        $advertisements = Advertisement::where('published_on', '!=', null)->get();

        return view('welcome')->with(['headlines'=>$headlines ,'main_spotlight' => $main_spotlight, 'main_latest' => $main_latest, 'main_latest_count'=>$main_latest_count, 'opinions'=>$opinions, 'advertisements'=>$advertisements, 'category_world_spotlight'=>$category_world_spotlight, 'category_gcc_spotlight'=>$category_gcc_spotlight, 'category_gcc'=>$category_gcc, 'category_business_spotlight'=>$category_business_spotlight, 'category_weather_spotlight'=>$category_weather_spotlight, 'category_sports_spotlight'=>$category_sports_spotlight, 'category_lifestyle_spotlight'=>$category_lifestyle_spotlight, 'category_world'=>$category_world, 'category_business'=>$category_business, 'category_weather'=>$category_weather, 'category_sports'=>$category_sports, 'category_lifestyle'=>$category_lifestyle]);
    }

    public function category($category)
    {
        $coun = Cache::get('country');

        if($category == 'gcc')
        {
            
            $articles = News::where('category', $category)->where('publish_date', '!=', null)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->paginate(12);
            return view('category')->with(['category' => 'GCC', 'articles' => $articles]);
        }

        $articles = News::where('category', $category)->where('publish_date', '!=', null)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->paginate(12);


        if($category == 'opinion')
        {
            $authors = News::select('user_id')->where('category', 'Opinion')->groupBy('user_id')->get();

            
            return view('category')->with(['category' => $category, 'authors'=>$authors, 'articles' => $articles]);
        }
        else
        {
            return view('category')->with(['category' => $category, 'articles' => $articles]);
        }
    }

    public function getLatest()
    {
        if(Cache::has('country'))
        {
            $articles = News::where('country', Cache::get('country'))->where('publish_date', '!=', null)->where('latest', 1)->where('homepage', 1)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->paginate(12);
        }
        else
        {
            $articles = News::where('publish_date', '!=', null)->where('latest', 1)->where('homepage', 1)->orderByRaw('DATE(publish_date) DESC')->orderBy('priority', 'ASC')->orderByRaw('TIME(publish_date) DESC')->paginate(12);
        }

        return view('category')->with(['category' => 'Latest', 'articles' => $articles]);
    }

    public function article($id)
    {
        $article = News::where('id', $id)->first();

        $comment_count_admin = $article->comments()->count();
        $comment_count = $article->comments()->where('confirmed', 1)->count();
        $advertisements = Advertisement::where('published_on', '!=', null)->get();

        $related = News::where('publish_date', '!=', null)->where('category', $article->category)->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();
        $latest = News::where('publish_date', '!=', null)->where('id', '!=', $article->id)->orderBy('created_at', 'DESC')->take(4)->get();

        return view('article')->with(['article' => $article, 'comment_count' => $comment_count, 'comment_count_admin' => $comment_count_admin, 'related' => $related, 'latest' => $latest, 'advertisements'=>$advertisements]);
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
        $coun = Cache::get('country');

        $authors = News::where('country', $coun)->select('user_id')->where('category', 'Opinion')->groupBy('user_id')->get();
        $columns = News::where('country', $coun)->where('category', 'Opinion')->orderBy('created_at', 'DESC')->paginate(12);

        return view('category')->with(['category'=>'Columns', 'authors'=>$authors, 'articles'=>$columns]);
    }

    public function getUserColumns($id)
    {
        $coun = Cache::get('country');

        $authors = News::where('country', $coun)->select('user_id')->where('category', 'Opinion')->groupBy('user_id')->get();
        $columns = News::where('country', $coun)->where('category', 'Opinion')->where('user_id', $id)->orderBy('created_at', 'DESC')->paginate(12);
        return view('category')->with(['category'=>'Columns', 'articles'=>$columns, 'user'=>User::where('id', $id)->first(), 'authors'=>$authors]);
    }

    // public function getMedia()
    // {
    //     $articles = News::where('publish_date', '!=', null)->where('type', 'article')->orderBy('created_at', 'DESC')->paginate(12);
    //     return view('category')->with(['category'=>'Media', 'articles'=>$articles]);
    // }

    public function getTag($id)
    {
        $coun = Cache::get('country');
        
        $tags = Tag::orderBy('created_at', 'DESC')->get();
        $articles = Tag::where('id', $id)->first()->news()->where('country', $coun)->orderBy('created_at', 'DESC')->paginate(12);
        return view('tags')->with(['tag_name'=>Tag::where('id', $id)->first()->title ,'tags'=>$tags, 'articles'=>$articles]);
    }

    public function userSubmission()
    {
        //$categories = Category::where('active', 1)->orderBy('name', 'asc')->get();
        return view('userSubmission');
    }

    public function postAddNews(Request $request)
    {
        $this->validate(
            $request,
            [
                'title'=>'required',
                'category'=>'required',
                'country'=>'required',
                'summary'=>'required',
                'descr'=>'required',
                // 'image-data'=>'required_unless:category,Opinion',
            ], 
            [
                'country.required'=>'Country is required',
                'category.required'=>'Category is required',
                'descr.required'=>'Description is required', 
                'image-data.required_unless'=>'Image is required for selected category'
            ]
        );

        //return $request->all();
        $news = new News();
        $news->user_id = Auth::user()->id;
        $news->title = $request['title'];
        // $news->type = $request['type'];
        $news->category = $request['category'];
        $news->country = $request['country'];
        
        $news->summary = $request['summary'];
        $news->description = $request['descr'];

        if(Auth::user()->type == 'admin')
        {
            $news->priority = $request['priority'];
            $news->duration = $request['duration'];

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
            {
                $news->publish_date = null;
            }
        }
        else
        {
            $news->active = 0;
            $news->duration = 0;
            $news->publish_date = null;
        }

        

        //decode the url, because we want to use decoded characters to use explode
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


    // public function postAjaxAddNews(Request $request)
    // {
    //     $this->validate(
    //         $request,
    //         [
    //             'title'=>'required',
    //             'category'=>'required',
    //             'country'=>'required',
    //             'summary'=>'required',
    //             'descr'=>'required',
    //             'image-data'=>'required_unless:category,Opinion',
    //         ], 
    //         [
    //             'title.required'=>'Title is required',
    //             'summary.required'=>'Summary is required',
    //             'country.required'=>'Country is required',
    //             'category.required'=>'Category is required',
    //             'descr.required'=>'Description is required', 
    //             'image-data.required_unless'=>'Image is required for selected category'
    //         ]
    //     );

    //     //return $request->all();
    //     $news = new News();
    //     $news->user_id = Auth::user()->id;
    //     $news->title = $request['title'];
    //     // $news->type = $request['type'];
    //     $news->category = $request['category'];
    //     $news->country = $request['country'];
        
    //     $news->summary = $request['summary'];
    //     $news->description = $request['descr'];
    //     $news->priority = $request['priority'];

    //     if(isset($request['homepage']) && isset($request['latest']) && isset($request['spotlight']))
    //     {
    //         $checking = News::where('homepage', 1)->where('spotlight', 1)->where('latest', 1)->get();
    //         foreach($checking as $check)
    //         {
    //             $check->spotlight = 0;
    //             $check->update();
    //         }
    //     }

    //     if(isset($request['latest']))
    //     {
    //         $news->latest = 1;
    //     }

    //     if(isset($request['homepage']))
    //     {
    //         $news->homepage = 1;
    //     }
    //     else
    //         $news->homepage = 0;

    //     if(isset($request['spotlight']))
    //     {

    //         $news->spotlight = 1;
    //     }
    //     else
    //         $news->spotlight = 0;

    //     if(isset($request['publish']))
    //     {
    //         $news->publish_date = Carbon::now();
    //     }
    //     else
    //     {
    //         $news->publish_date = null;
    //     }

    //     //decode the url, because we want to use decoded characters to use explode
    //     if(isset($request['image-data']))
    //     {
    //         $img = $request['image-data'];

    //         //decode the url, because we want to use decoded characters to use explode
    //         $decoded = urldecode($img);

    //         //get image extension
    //         $ext = explode(';', $decoded);
    //         $ext = explode(':', $ext[0]);
    //         $ext = array_pop($ext);
    //         $ext = explode('/', $ext);
    //         $ext = array_pop($ext);

    //         //save image in file
    //         $img_name = "perfil-".time().".".$ext;
    //         $path = public_path() . "/images/news/" . $img_name;
    //         $img = substr($img, strpos($img, ",")+1);
    //         $data = base64_decode($img);
    //         $success = file_put_contents($path, $data);

    //         $error = '';
    //         $success ? $news->picture = $img_name : $error = 'Unable to save cover image';
    //     }

    //     $news->save();

    //     $tags = explode(',', $request['tags']);
    //     foreach($tags as $tag)
    //     {
    //         $tag_id = Tag::where('title', $tag)->first();
    //         if(!isset($tag_id->id))
    //         {
    //             $tag_id = new Tag();
    //             $tag_id->title = $tag;
    //             $tag_id->save();
    //         }
    //         $news->tags()->attach($tag_id);
    //     }
    //     return response('submitted');
    // }

    public function getDeleteComment($comment_id)
    {
        if(Auth::guest())
        {
            return redirect()->back();
        }

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

    public function getCommentApprove($comment_id)
    {
        if(Auth::guest())
        {
            return redirect()->back();
        }
        
        $comment = Comment::where('id', $comment_id)->get()->first();
        $comment->confirmed = 1;
        $comment->update();
        return redirect()->back();

    }

    public function getCommentDisapprove($comment_id)
    {
        if(Auth::guest())
        {
            return redirect()->back();
        }

        $comment = Comment::where('id', $comment_id)->get()->first();
        $comment->confirmed = 0;
        $comment->update();
        return redirect()->back();
    }

    public function getCurrenctExchangeAjax()
    {
        header('Content-Type: text/plain');

        $amount = $_GET['amount'];
        $source_currency = $_GET['source_currency'];
        $target_currency = $_GET['target_currency'];

        $ex_rate = floatval(file_get_contents('http://download.finance.yahoo.com/d/quotes.csv?s='.$source_currency.$target_currency.'=X&f=l1'));
        echo round($ex_rate*$amount, 2);
    }

    public function getImpLinks()
    {
        $country = Cache::get('country');
        $links = About::where('type', 'links')->where('country', $country)->first();
        return view('implinks')->with('links', $links);
    }

    public function getAboutGcc()
    {
        $about_gcc = About::where('type', 'aboutgcc')->first()->description;
        return view('aboutgcc')->with(['about_gcc'=>$about_gcc]);
    }
}
