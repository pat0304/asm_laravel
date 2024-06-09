<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public array $cart = [];
    public function index()
    {
        return view('user.cart.index', ["title" => "Giỏ hàng"]);
    }
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $oldCart = Session('cart') ? Session('cart') : null;
        $currentCart = new Cart($oldCart);
        $currentCart->addCart($request->id, $product, $request->quantity);

        $request->session()->put('cart', $currentCart);
        return redirect()->route('cart.index');
    }
    public function increase($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $oldCart = Session('cart') ? Session('cart') : null;
        $currentCart = new Cart($oldCart);
        $currentCart->addCart($request->id, $product, 1);

        $request->session()->put('cart', $currentCart);
        return redirect()->route('cart.index');
    }
    public function decrease($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $oldCart = Session('cart') ? Session('cart') : null;
        $currentCart = new Cart($oldCart);
        $currentCart->addCart($request->id, $product, -1);

        $request->session()->put('cart', $currentCart);
        // $request->session()->forget('cart');
        // echo "<pre>";
        // print_r(Session('cart'));


        return redirect()->route('cart.index');
    }
    public function delete(Request $request)
    {
        $oldCart = Session('cart');
        $currentCart = new Cart($oldCart);
        $currentCart->del($request->id);
        $request->session()->put('cart', $currentCart);
        return redirect()->route('cart.index');
    }
}