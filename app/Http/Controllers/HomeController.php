<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = order::with(['users'])->get();
        return view('home', compact('orders'));
    }

    public function updateOrder($id, $status)
    {
        $order = order::find($id);
        if ($order) {
            $order->order_date = now()->format('Y-m-d');
            $order->order_time = now()->format('H:i:s');
            if ($status == 'pending') {
                $order->status = 'under process';
            } elseif ($status == 'under process') {
                $order->status = 'done';
            }
            $order->paid = 1;
            $order->save();
            return redirect()->back();
        }
    }

    public function paidOrders()
    {
        $orders = order::with(['users'])->where('paid', 1)->get();
        return view('paid', compact('orders'));
    }
    public function confirm()
    {
        return view('confirm');
    }
}
