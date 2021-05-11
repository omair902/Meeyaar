<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class DispatchedOrderController extends Controller
{
    public function index()
    {
        $orders=Order::where('status','dispatched')->latest()->get();
        return view('admin.order_management.dispatched',compact('orders'));
    }
}
