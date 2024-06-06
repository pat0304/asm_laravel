<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $table = 'products';
    public function index()
    {
        $title = 'Home';
        $new = DB::table($this->table)->orderBy('id', 'desc')->limit(3)->get();
        $sale = DB::table($this->table)->whereNotNull('sale')->limit(3)->get();
        return view('user.home.index', ['title' => $title, 'sale' => $sale, 'new' => $new]);
    }
}