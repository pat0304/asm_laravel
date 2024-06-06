<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getCategory()
    {
        return DB::table('post_categories')->get();
    }
    public function getCategoryName($id)
    {
        $data = DB::table('posts')->where('id', $id)->get();
        return DB::table('post_categories')->select('name')->where('id', $data[0]->category_id)->first()->name;
    }
    public function index()
    {
        $query = $_GET['sort'] ?? null;
        $data = DB::table('posts')->get();
        if ($query != null && ($query == "id" || $query == "view")) {
            $data = DB::table('posts')->orderBy($_GET['sort'], 'desc')->get();
        }
        return view('user.post.index', ['title' => 'Post', 'cata' => $this->getCategory(), 'data' => $data]);
    }
    public function detail($id)
    {
        $data = DB::table('posts')->where('id', $id)->first();
        $title = $data->title;
        return view('user.post.detail', ['data' => $data, 'title' => $title, 'nameCata' => $this->getCategoryName($id)]);
    }
    public function category($id)
    {
        $query = $_GET['sort'] ?? null;
        $data = DB::table('posts')->where('category_id', $id)->get();
        if ($query != null && ($query == "id" || $query == "view")) {
            $data = DB::table('posts')->where('category_id', $id)->orderBy($query, 'desc')->get();
        }
        return view('user.post.index', ['data' => $data, 'cata' => $this->getCategory(), 'title' => 'Post']);
    }

}