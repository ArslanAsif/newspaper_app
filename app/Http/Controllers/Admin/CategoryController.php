<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.manage_categories')->with('categories', $categories);
    }

    public function getAddCategory()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.create_category',['categories'=> $categories,'check'=>'add']);
    }

    public function postAddCategory(Request $request)
    {

        $category = new Category();
        $category->name = $request['category'];
        $category->category_id = $request['parent-category'];
        $category->priority = $request['priority'];


            if($request['active'] == 'on')
                $category->active = 1;
            else
                $category->active = 0;



            if($request['latest'] == 'on')
                $category->latest = 1;
            else
                $category->latest = 0;


            if ($request['homepage'] == 'on')
                $category->homepage = 1;
            else
                $category->homepage = 0;

        $category->save();

        return redirect()->back();
    }

    public function getEditCategory($id)
    {
        $cateData = Category::where('id',$id)->get();
        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.create_category',['categories'=> $categories,'cateData'=>$cateData,'check'=>'update']);
    }

    public function postEditCategory(Request $request)
    {

        $id=$request['id'];
        $category = Category::find($id);
        $category->name = $request['category'];
        $category->category_id = $request['parent-category'];
        $category->priority = $request['priority'];


            if($request['active'] == 'on')
                $category->active = 1;
            else
                $category->active = 0;


        if($request['latest'] == 'on')
            $category->latest = 1;
        else
            $category->latest = 0;


        if ($request['homepage'] == 'on')
            $category->homepage = 1;
        else
            $category->homepage = 0;
        $category->save();

        return redirect()->back();    }

    public function getDeleteCategory()
    {
        return view('admin.manage_categories');
    }
}
