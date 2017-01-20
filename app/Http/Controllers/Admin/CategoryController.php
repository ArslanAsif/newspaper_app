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

        if($request['parent-category'] != '')
        {
            $category->category_id = $request['parent-category'];
        }

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
        $cateData = Category::where('id',$id)->first();
        $categories = Category::where('id' ,'!=', $id)->orderBy('name', 'ASC')->get();

        return view('admin.create_category',['categories'=> $categories,'cateData'=>$cateData]);
    }

    public function postEditCategory(Request $request)
    {
        $category = Category::where('id', $request['id'])->first();

        $category->name = $request['category'];

        if($request['parent-category'] == '')
            $category->category_id = null;

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

        $category->update();

        return redirect()->back();    }

    public function getDeleteCategory()
    {
        return view('admin.manage_categories');
    }
}
