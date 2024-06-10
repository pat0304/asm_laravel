<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
        return view('admin.order.detail', compact('order_detail', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Thay đổi trạng thái thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $request->validate([
            'search_content' => 'required'
        ], [
            'search_content.required' => 'Vui lòng nhập nội dung tìm kiếm'
        ]);
        $orders = Order::where('id', 'like', $request->input('search_content'))->get();
        // return redirect()->route('orders.index', compact('orders'));
        return view('admin.order.index', compact('orders'));
    }
}