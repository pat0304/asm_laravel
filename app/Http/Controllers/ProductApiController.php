<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductApiResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::all();
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => ProductApiResource::collection($products)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
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
        try {
            $product = null;
            $imgPath = $request->file('image')->store('/public/image');
            $imgName = basename($imgPath);
            if ($request->sale != null || $request->sale != 0) {
                if ($request->sale >= $request->price) {
                    return response()->json([
                        'status' => 400,
                        'message' => "Sale price must be lower than price"
                    ], 400);
                }
                $product = Product::create([
                    'name' => $request->name,
                    'image' => '/storage/image/' . $imgName,
                    'price' => $request->price,
                    'sale' => $request->sale,
                    'description' => $request->description,
                    'warehouse' => $request->warehouse,
                    'category_id' => (int) $request->category_id
                ]);
            } else {
                $product = Product::create([
                    'name' => $request->name,
                    'image' => '/storage/image/' . $imgName,
                    'price' => $request->price,
                    'sale' => null,
                    'description' => $request->description,
                    'warehouse' => $request->warehouse,
                    'category_id' => $request->category_id
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Product created successfully',
                'data' => new ProductApiResource($product)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $user = Product::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Lấy dữ liệu thành công',
                'data' => new ProductApiResource($user),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
                'data' => null,
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
        ]);
        try {
            $product = Product::findOrFail($id);
            $product->name = $request->name ?? $product->name;
            $product->description = $request->description ?? $product->description;
            $product->price = $request->price ?? $product->price;
            if ($request->sale != null) {
                if ($request->sale >= $request->price) {
                    return response()->json([
                        'status' => 400,
                        'message' => "Sale price must be lower than price"
                    ], 400);
                }
                $product->sale = $request->sale ?? $product->sale;
            }
            $product->warehouse = $request->warehouse ?? $product->warehouse;
            $product->category_id = $request->category_id ?? $product->category_id;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('/public/image/');
                $product->image = '/storage/image/' . basename($imagePath);
            }
            $product->save();
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => new ProductApiResource($product),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Deleted successfully',
                'data' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}