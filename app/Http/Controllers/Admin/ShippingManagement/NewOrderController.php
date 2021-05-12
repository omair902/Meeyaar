<?php

namespace App\Http\Controllers\Admin\ShippingManagement;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\OrderComplain;

class NewOrderController extends Controller
{
    public function index()
    {
        $orders=Order::where('status','pending')->latest()->get();
        return view('admin.shipping_management.new',compact('orders'));
    }

    public function dispatched($id)
    {
        $order=Order::find($id);
        $order->status='dispatched';
        $order->update();
        if($order)
        {
            Session::flash('dispatched','Order Dispatched Sucessfully');
            return redirect()->route('admin.shipping_management.new');
        }
    }
    public function completed($id)
    {
        $order=Order::find($id);
        $order->status='completed';
        $order_product=$order->order_product;
        foreach($order_product as $ord_pro)
        {
            $product=Product::find($ord_pro->product_id);
            $stock=Stock::where('product_id',$ord_pro->product_id)->first();
            $current_sold=$stock->sold;
            $stock->sold=$current_sold + $ord_pro->quantity;
            $stock->update();
        }
        $order->update();
        if($order)
        {
            Session::flash('dispatched','Order Completed Sucessfully');
            return redirect()->route('admin.shipping_management.new');
        }
    }

    public function complain(Request $request,$id)
    {
        $complain=new OrderComplain;
        $complain->order_id=$id;
        $complain->description=$request->description;
        $complain->save();

        if($complain)
        {
            Session::flash('registered','Complain Registered Successfully');
            return redirect()->back();
        }
        
    }
}
