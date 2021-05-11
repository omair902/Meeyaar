<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PendingOrderController extends Controller
{
    public function index()
    {
        $orders=Order::where('status','pending')->latest()->get();
        return view('admin.order_management.pending',compact('orders'));
    }
}
