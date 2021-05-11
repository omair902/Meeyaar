<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\SkuNumber;
use App\Models\Stock;
use App\Models\OrderProduct;
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
        
        $order->user_id=Auth::user()->id;
        
        $order->save();
        $order_product=new OrderProduct;
        $order_product->sku_number=$product_name.$sub_category_name.'-'.$sku->number;
        $order_product->order_id=$order->id;
        $order_product->product_id=$product_id;
        $order_product->quantity=1;
        $order_product->save();
        $stock=Stock::where('product_id',$product_id)->first();
        $current=$stock->current;
        $stock->current=$current - 1;
        $stock->update();
        if($order)
        {
            return redirect()->back();
        }
    }
}
