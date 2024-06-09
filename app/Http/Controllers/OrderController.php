<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('user.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $product_list = OrderDetail::where('order_id', $order->id)->get();
        $order_detail = [
            'products' => [],
            'totalPrice' => $order->total,
            'totalQuantity' => $order->amount
        ];
        foreach ($product_list as $item) {
            $product = Product::findOrFail($item->product_id);
            $product_info = [
                'product' => $product,
                'total' => $item->total,
                'quantity' => $item->amount
            ];
            $order_detail['products'][$product->id] = $product_info;
        }
        return view('user.order.detail', compact('order_detail', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}