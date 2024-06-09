<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use Session;

class CheckOutController extends Controller
{
    public function index()
    {
        return view('user.checkout.index');
    }
    public function checkout(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ], [

        ]);
        $bill = Session('cart');
        $user_id = Auth::user()->id;
        $order = Order::create([
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'address' => $request->address,
            'phone' => $request->phone,
            'amount' => $bill->totalQuantity,
            'total' => $bill->totalPrice,
            'user_id' => $user_id
        ]);
        foreach ($bill->products as $item) {
            OrderDetail::create([
                'product_id' => $item['product']['id'],
                'order_id' => $order->id,
                'amount' => $item['quantity'],
                'total' => $item['total']
            ]);
        }
        $request->session()->forget('cart');
        return redirect('/')->with('success', 'Đơn hàng đã được đặt');
    }
}