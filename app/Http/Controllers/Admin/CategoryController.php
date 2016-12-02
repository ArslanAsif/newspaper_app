<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
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
        return view('admin.create_category');
    }

    public function postAddCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request['category'];
        //$category->category_id = $request['parent_category'];
        $category->priority = $request['priority'];

        if(isset($request['active']))
        {
            if($request['active'] == 'on')
                $category->active = 1;
            else
                $category->active = 0;
        }

        if(isset($request['latest']))
        {
            if($request['latest'] == 'on')
                $category->latest = 1;
            else
                $category->latest = 0;
        }

        if(isset($request['homepage']))
        {
            if ($request['homepage'] == 'on')
                $category->homepage = 1;
            else
                $category->homepage = 0;
        }

        $category->save();

        return redirect()->back();
    }

    public function getEditCategory()
    {
        return view('admin.create_category');
    }

    public function postEditCategory()
    {
        return view('admin.create_category');
    }

    public function getDeleteCategory()
    {
        return view('admin.manage_categories');
    }
}
