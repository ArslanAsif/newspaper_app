<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\News;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    	$users_count = User::where('type', '!=', 'admin')->count();
    	
    	$users = User::where('type', '!=', 'admin')->get();
    	$users_count_today = 0;
    	foreach ($users as $user) {
			$created_at= Carbon::parse($user->created_at);
			$dt = Carbon::now();

			if($dt->diffInDays($created_at) == 0)
				$users_count_today++;
    	}

    	$submissions_count = News::count();

    	$submissions = News::all();
    	$submissions_count_today = 0;
    	foreach ($submissions as $news) {
			$created_at= Carbon::parse($news->created_at);
			$dt = Carbon::now();

			if($dt->diffInDays($created_at) == 0)
				$submissions_count_today++;
    	}

    	$comments_count = Comment::count();

    	$comments = Comment::all();
    	$comments_count_today = 0;
    	foreach ($comments as $comment) {
			$created_at= Carbon::parse($comment->created_at);
			$dt = Carbon::now();

			if($dt->diffInDays($created_at) == 0)
				$comments_count_today++;
    	}

        return view('admin.dashboard')->with(['users_count'=>$users_count, 'users_count_today'=>$users_count_today, 'submissions_count'=>$submissions_count, 'submissions_count_today'=>$submissions_count_today, 'comments_count'=>$comments_count, 'comments_count_today'=>$comments_count_today]);
    }
}
