<?php

namespace App\Http\Controllers\Admin;

use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
