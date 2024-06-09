<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        return view('admin.users.create');
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
            'name.required' => 'Please enter User\'s name',
            'image.required' => 'Hình ảnh bài viết là bắt buộc.',
            'image.image' => 'Tệp phải là ảnh.',
            'image.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước ảnh không được vượt quá :max KB.',
        ]);
        $imgPath = $request->file('image')->store('/public/image');
        $imgName = basename($imgPath);
        if ($request->sale != null || $request->sale != 0) {
            if ($request->sale >= $request->price) {
                return redirect()->route('users.create')->with('fail', 'Giá khuyến mãi không được lớn hơn giá gốc');
            }
            User::create([
                'name' => $request->name,
                'image' => '/storage/image/' . $imgName,
                'price' => $request->price,
                'sale' => $request->sale,
                'description' => $request->description,
                'warehouse' => $request->warehouse,
                'category_id' => (int) $request->category_id
            ]);
        } else {
            User::create([
                'name' => $request->name,
                'image' => '/storage/image/' . $imgName,
                'price' => $request->price,
                'sale' => null,
                'description' => $request->description,
                'warehouse' => $request->warehouse,
                'category_id' => $request->category_id
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Thêm sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        return view('admin.users.update', compact('user'));
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
            'name.required' => 'Please enter User\'s name',
            'image.image' => 'Tệp phải là ảnh.',
            'image.mimes' => 'Chỉ chấp nhận các định dạng ảnh: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước ảnh không được vượt quá :max KB.',
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->description = $request->description;
        $user->price = $request->price;
        if ($request->sale != null) {
            if ($request->sale >= $request->price) {
                return redirect()->route('users.edit', $user->id)->with('fail', 'Giá khuyến mãi không được lớn hơn giá gốc');
            }
            $user->sale = $request->sale;
        }
        $user->warehouse = $request->warehouse;
        $user->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('/public/image/');
            $user->image = '/storage/image/' . basename($imagePath);
        }
        $user->save();
        return redirect()->route('users.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user_info = $user;
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Bạn vừa xóa thành công người dùng "' . $user_info->id . ' - ' . $user_info->username . '"');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search_content' => 'required'
        ], [
            'search_content.required' => 'Vui lòng nhập nội dung tìm kiếm'
        ]);
        $users = User::all();
        if ($request->search_value == 'id') {
            $users = User::where('id', 'like', $request->search_content)->get();
        } else {
            $users = User::where('username', 'like', '%' . $request->search_content . '%')->get();
        }
        return view('admin.users.index', compact('users'));
    }
}