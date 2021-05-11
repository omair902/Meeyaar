<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class CancelledOrderController extends Controller
{
    public function index()
    {
        $orders=Order::where('status','cancelled')->latest()->get();
        return view('admin.order_management.cancelled',compact('orders'));
    }
}
