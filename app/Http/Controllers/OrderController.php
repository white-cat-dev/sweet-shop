<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $orders = Order::orderBy('execution_date', 'DESC')->get();

        return view('orders')->with(['orders' => $orders, 'statuses' => Order::$statuses]);
    }


    public function findStatus($status)
    {
        $orders = Order::where('status', '=', $status)->get();

        return view('orders')->with(['orders' => $orders, 'statuses' => Order::$statuses]);
    }


    public function update($id, Request $request) 
    {
        /*$this->validate($request, [
            'title' => 'required|max:255',
            'units' => 'required|max:255',
            'count' => 'required|number',
        ]);*/
        $order = Order::findOrFail($id);

        $orderInfo = $request->all();

        $order->update($orderInfo);

        return redirect('/orders');
    }


    public function delete($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect('/cakes');
    }
}
