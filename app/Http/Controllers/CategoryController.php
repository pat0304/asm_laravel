<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Please enter category\'s name'
        ]);
        Category::create([
            'name' => $request->name
        ]);
        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);
        return view('admin.categories.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Please enter category\'s name'
        ]);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Sửa danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->id == 1) {
            return redirect()->route('categories.index')->with('fail', 'Không thể xóa danh mục Mặc đinh (id = 1)');
        }
        $products = Product::where('category_id', '=', $category->id)->get();
        foreach ($products as $product) {
            $product->category_id = 1;
            $product->save();
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công, tất cả sản phẩm trong danh mục này đã được chuyển vào danh mục Mặc định');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search_content' => 'required'
        ]);
        $request->validate([
            'search_content.required' => 'Vui lòng nhập nội dung tìm kiếm'
        ]);
        $categories = Category::all();
        if ($request->search_value == 'id') {
            $categories = Category::where('id', 'like', $request->search_content)->get();
            Product::groupBy('category_id');
        } else {
            $categories = Category::where('name', 'like', '%' . $request->search_content . '%')->get();
        }
        return view('admin.categories.index', compact('categories'));
    }
}