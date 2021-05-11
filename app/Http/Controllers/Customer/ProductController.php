<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\SkuNumber;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products=Product::paginate(1);
        return view('customer.products',compact('products'));
    }

    public function order($product_id)
    {
        $product=Product::find($product_id);
        $product_name=substr($product->title,0,2);
        $sub_category_name=substr($product->subcategory[0]->name,0,2);
        $sku=SkuNumber::first();
        $sku_number=$sku->number;
        $sku->number=$sku_number + 1;
        $sku->update();
        $order=new Order;
        $order->sku_number=$product_name.$sub_category_name.'-'.$sku->number;
        $order->product_id=$product_id;
        $order->user_id=Auth::user()->id;
        $order->save();
        if($order)
        {
            return redirect()->back();
        }
    }
}
