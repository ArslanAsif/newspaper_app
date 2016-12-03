<?php

namespace App\Http\Controllers\Admin;

use App\Advertisement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisment=Advertisement::get();
        return view('admin.manage_advertisements',['advertisment'=>$advertisment]);
    }

    public function getAddAdvertisement()
    {
        return view('admin.create_advertisement',['check'=>'add']);
    }

    public function postAddAdvertisement(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
        ]);
        $advertisement=new Advertisement();
        $advertisement->title=$request['title'];
        $advertisement->position=$request['position'];
        $advertisement->image="sd";
        $advertisement->url=$request['url'];
        $advertisement->detail=$request['detail'];
        $advertisement->validity="1";
        if($advertisement->save()){
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }

    }

    public function getEditAdvertisement($id)
    {
        $advertisement = Advertisement::where('id',$id)->get();
        return view('admin.create_advertisement',['advertisement'=>$advertisement,'check'=>'edit']);
    }

    public function postEditAdvertisement(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
        ]);
        $id=$request['id'];
        $advertisement = Advertisement::find($id);
        $advertisement->title=$request['title'];
        $advertisement->position=$request['position'];
        $advertisement->image="sd";
        $advertisement->url=$request['url'];
        $advertisement->detail=$request['detail'];
        if($request['status']!='')
            $advertisement->validity="1";
        else
            $advertisement->validity="0";

        if($advertisement->save()){
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
        return view('admin.create_advertisement');
    }

    public function getDeleteAdvertisement($id)
    {
        $advertisement = Advertisement::find($id);
        if($advertisement){
            $advertisement->delete();
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
    }
}
