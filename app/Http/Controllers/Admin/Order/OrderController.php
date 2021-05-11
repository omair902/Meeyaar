<?php

namespace App\Http\Controllers\Admin\Order;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class OrderController extends Controller
{
    public function index()
    {
        $orders=Order::where('status','new')->latest()->get();
        return view('admin.order_management.new',compact('orders'));
    }

    public function view_product($product_id)
    {
        $product=Product::find($product_id);
        return view('product',compact('product'));
    }

    public function confirmed($id)
    {
        $order=Order::find($id);
        $order->status='pending';
        $order->update();
        if($order)
        {
            Session::flash('confirmed','Order Confirmed Sucessfully');
            return redirect()->route('admin.manage_orders.new');
        }
    }

    public function cancelled($id)
    {
        $order=Order::find($id);
        $order->status='cancelled';
        $order->update();
        if($order)
        {
            Session::flash('cancelled','Order Cancelled Sucessfully');
            return redirect()->route('admin.manage_orders.new');
        }
    }
}
