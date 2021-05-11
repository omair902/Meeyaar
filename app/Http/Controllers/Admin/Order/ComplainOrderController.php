<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderComplain;
class ComplainOrderController extends Controller
{
    public function index()
    {
        $complains=OrderComplain::where('status','current')->latest()->get();
        return view('admin.order_management.complains.current',compact('complains'));
    }

    public function refunded()
    {
        $complains=OrderComplain::where('status','refunded')->latest()->get();
        return view('admin.order_management.complains.refunded',compact('complains'));
    }

    public function resolved()
    {
        $complains=OrderComplain::where('status','resolved')->latest()->get();
        return view('admin.order_management.complains.resolved',compact('complains'));
    }
}

