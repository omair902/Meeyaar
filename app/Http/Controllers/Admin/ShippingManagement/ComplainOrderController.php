<?php

namespace App\Http\Controllers\Admin\ShippingManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderComplain;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use Session;
class ComplainOrderController extends Controller
{
    public function index()
    {
        $complains=OrderComplain::where('status','current')->latest()->get();
        return view('admin.shipping_management.complains.current',compact('complains'));
    }

    public function refunded($id)
    {
        $complain=OrderComplain::find($id);
        $complain->status='refunded';
        $complain->update();

        $order=Order::find($complain->order_id);
        $order->status='refunded';
        $order->update();
        $order_product=$order->order_product;
        
        foreach($order_product as $ord_pro)
        {
            $product=Product::find($ord_pro->product_id);
            $stock=Stock::where('product_id',$product->id)->first();
            $current=$stock->current;
            $stock->current=$current + $order->quantity;
            $stock->update();
        }
        if($order)
        {
            Session::flash('refunded','Refunded Sucessfully');
            return redirect()->back();
        }
    }

    public function resolved($id)
    {
        $complain=OrderComplain::find($id);
        $complain->status='resolved';
        $complain->update();

        if($complain)
        {
            Session::flash('resolved','Resolved Sucessfully');
            return redirect()->back();
        }
    }

    public function refunded_complains()
    {
        $complains=OrderComplain::where('status','refunded')->latest()->get();
        return view('admin.shipping_management.complains.refunded',compact('complains'));
    }

    
    public function resolved_complains()
    {
        $complains=OrderComplain::where('status','resolved')->latest()->get();
        return view('admin.shipping_management.complains.resolved',compact('complains'));
    }
}
