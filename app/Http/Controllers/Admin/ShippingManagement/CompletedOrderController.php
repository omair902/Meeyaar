<?php

namespace App\Http\Controllers\Admin\ShippingManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class CompletedOrderController extends Controller
{
    public function index()
    {
        $orders=Order::where('status','completed')->latest()->get();
        return view('admin.shipping_management.completed',compact('orders'));
    }
}
