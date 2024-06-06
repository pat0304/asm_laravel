<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $sort = null;
        if (isset($_GET['sort']) && $_GET['sort'] != '') {
            $sort = $_GET['sort'];
        }
        if ($sort != null) {
            if ($sort == 'decrease') {
                $data = DB::table('products')->orderBy('price', 'desc')->get();
            } elseif ($sort == 'increase') {
                $data = DB::table('products')->orderBy('price')->get();
            } elseif ($sort == 'sale') {
                $data = DB::table('products')->whereNotNull('sale')->get();
            } else {
                $data = DB::table('products')->get();
            }
        } else {
            $data = DB::table('products')->get();
        }

        return view('user.shop.index', ['title' => 'Cửa hàng', 'data' => $data]);
    }
    public function detail($id)
    {
        $data = DB::table('products')->where('id', '=', $id)->first();
        $new = DB::select('
            SELECT * FROM products WHERE category_id = ' . $data->category_id . ' AND id <> ' . $id . ' ORDER BY RAND() LIMIT 3;');
        return view('user.shop.detail', ['title' => $data->name, 'data' => $data, 'sale' => $new]);
    }
    public function category($category_id)
    {
        $sort = null;
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        }
        if ($sort != null) {
            if ($sort == 'decrease') {
                $data = DB::table('products')->where('category_id', '=', $category_id)->orderBy('price', 'desc')->get();
            } elseif ($sort == 'increase') {
                $data = DB::table('products')->where('category_id', '=', $category_id)->orderBy('price')->get();
            } elseif ($sort == 'sale') {
                $data = DB::table('products')->whereNotNull('sale')->where('category_id', '=', $category_id)->get();
            }
        } else {
            $data = DB::table('products')->where('category_id', '=', $category_id)->get();
        }

        return view('user.shop.index', ['title' => 'Cửa hàng', 'data' => $data]);
    }

}