<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::all();
        $sub_categories=SubCategory::all();
        return view('admin.products.manage_categories',compact('categories','sub_categories'));
    }

    public function store_category(CategoryRequest $request)
    {
        $existing_category=Category::where('name',$request->category_name)->first();
        if($existing_category == null)
        {
            $category=new Category;
            $name=$request->category_name;
            $category->name=$request->category_name;
            $category->save();
            if($category)
            {
                Session::flash('created','Category Created Sucessfully');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('already_exist','Category already exist');
            return redirect()->back();
        }
    }

    public function edit_category($id)
    {
        $category=Category::find($id);
        return $category;
    }

    public function update_category(CategoryRequest $request,$id)
    {
        $category=Category::find($id);
        $name=$request->category_name;
        $category->name=$name;
        $category->update();
        if($category)
        {
            Session::flash('updated','Category Updated Sucessfully');
            return redirect()->back();
        }
    }

    public function delete_category($id)
    {
        $category=Category::find($id);
        $category->delete();
        if($category)
        {
            Session::flash('deleted','Category Deleted Sucessfully');
            return redirect()->back();
        }
    }

    public function store_sub_category(SubCategoryRequest $request)
    {
        $existing_sub_category=SubCategory::where('name',$request->sub_category_name)->where('category_id',$request->category)->first();
        if($existing_sub_category == null)
        {
            $sub_category=new SubCategory;
            $sub_category->category_id=$request->category;
            $sub_category->name=$request->sub_category_name;
            $sub_category->save();
            if($sub_category)
            {
                Session::flash('created','Subcategory Created Sucessfully');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('sub_already_exist','Subcategory already exist');
            return redirect()->back();
        }
    }

    public function edit_sub_category($id)
    {
        $data=array();
        $sub_category=SubCategory::with('category')->find($id);
        $categories=Category::all();
        array_push($data,['sub_category'=>$sub_category,'categories'=>$categories]);
        return $data;
    }

    public function update_sub_category(SubCategoryRequest $request,$id)
    {
        $sub_category=SubCategory::find($id);
        $sub_category->category_id=$request->category;
        $sub_category->name=$request->sub_category_name;
        $sub_category->update();
        if($sub_category)
        {
            Session::flash('updated','Subcategory Updated Sucessfully');
            return redirect()->back();
        }
    }

    public function delete_sub_category($id)
    {
        $sub_category=SubCategory::find($id);
        $sub_category->delete();
        if($sub_category)
        {
            Session::flash('deleted','Subcategory Deleted Sucessfully');
            return redirect()->back();
        }
    }

}


