<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = OrderDetail::selectRaw('SUM(order_details.amount) as amount, product_id')
            ->join('orders', 'orders.id', '=', 'order_id')
            ->where('orders.status', 3)
            ->groupBy('product_id')
            ->orderByDesc('amount')
            ->limit(3)
            ->get();
        $products = [];
        foreach ($data as $i) {
            $product = Product::findOrFail($i->product_id);
            $products[$i->product_id] = ['amount' => $i->amount, 'product' => $product];
        }
        return view('admin.dashboard.index', compact('products'));
    }
}