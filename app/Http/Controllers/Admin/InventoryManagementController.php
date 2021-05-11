<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Session;
class InventoryManagementController extends Controller
{
    public function index()
    {
        $products=Product::with('subcategory')->latest()->get();
        return view('admin.inventory_management.index',compact('products'));
    }

    public function add_stock(Request $request,$id)
    {
        $stock=Stock::where('product_id',$id)->first();
        $current=$stock->current;
        $stock->current=$current + $request->no_of_stock;
        $stock->update();
        if($stock)
        {
            Session::flash('added','Stock Added Sucessfully');
            return redirect()->back();
        }
    }

    public function reduce_stock(Request $request,$id)
    {
        $stock=Stock::where('product_id',$id)->first();
        $current=$stock->current;
        $stock->current=$current - $request->no_of_stock;
        $stock->update();
        if($stock)
        {
            Session::flash('reduced','Stock Reduced Sucessfully');
            return redirect()->back();
        }
    }
    
    public function out_of_stock(Request $request,$id)
    {
        $stock=Stock::where('product_id',$id)->first();
        $stock->current=0;
        $stock->update();
        if($stock)
        {
            Session::flash('empty','Stock Empty Sucessfully');
            return redirect()->back();
        }
    }
}
