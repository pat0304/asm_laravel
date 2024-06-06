<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('id')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'warehouse' => 'required',
            'category_id' => 'required',
        ], [
            'name.required' => 'Please enter Product\'s name',
            'image.required' => 'Hình ảnh bài viết là bắt buộc.',
            'image.image' => 'Tệp phải là ảnh.',
            'image.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước ảnh không được vượt quá :max KB.',
        ]);
        $imgPath = $request->file('image')->store('/public/image');
        $imgName = basename($imgPath);
        if ($request->sale != null || $request->sale != 0) {
            if ($request->sale >= $request->price) {
                return redirect()->route('products.create')->with('fail', 'Giá khuyến mãi không được lớn hơn giá gốc');
            }
            Product::create([
                'name' => $request->name,
                'image' => '/storage/image/' . $imgName,
                'price' => $request->price,
                'sale' => $request->sale,
                'description' => $request->description,
                'warehouse' => $request->warehouse,
                'category_id' => (int) $request->category_id
            ]);
        } else {
            Product::create([
                'name' => $request->name,
                'image' => '/storage/image/' . $imgName,
                'price' => $request->price,
                'sale' => null,
                'description' => $request->description,
                'warehouse' => $request->warehouse,
                'category_id' => $request->category_id
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        return view('admin.products.update', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'warehouse' => 'required',
            'category_id' => 'required',
        ], [
            'name.required' => 'Please enter Product\'s name',
            'image.image' => 'Tệp phải là ảnh.',
            'image.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước ảnh không được vượt quá :max KB.',
        ]);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        if ($request->sale != null) {
            if ($request->sale >= $request->price) {
                return redirect()->route('products.edit', $product->id)->with('fail', 'Giá khuyến mãi không được lớn hơn giá gốc');
            }
            $product->sale = $request->sale;
        }
        $product->warehouse = $request->warehouse;
        $product->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('/public/image/');
            $product->image = '/storage/image/' . basename($imagePath);
        }
        $product->save();
        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        $product_info = $product;
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Bạn vừa xóa thành công sản phẩm "' . $product_info->id . ' - ' . $product_info->name . '"');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search_content' => 'required'
        ], [
            'search_content.required' => 'Vui lòng nhập nội dung tìm kiếm'
        ]);
        $products = Product::all();
        if ($request->search_value == 'id') {
            $products = Product::where('id', 'like', $request->search_content)->get();
        } else {
            $products = Product::where('name', 'like', '%' . $request->search_content . '%')->get();
        }
        return view('admin.products.index', compact('products'));
    }
}