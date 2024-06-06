@extends('admin.layout.app')

@section('content')
<h3 class="mb-3">Cập nhật thông tin sản phẩm</h3>
        @if($errors->any())
        <ul>
        @foreach ($errors->all() as $error)
        <li style="color:red">{{$error}}</li>
        @endforeach
        </ul>
        @endif
<form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row g-3" >
    <div class="col-md-3">
    <img src="{{url($product->image)}}" width="100%" alt=""></div>
    <div class="col-md-9">
      <label for="name" class="form-label">Tên sản phẩm</label>
      <input type="text" name="name" class="form-control" id="name" value="{{$product->name}}">
    </div>
    <div class="col-md-3">
      <label for="price" class="form-label">Giá gốc</label>
      <input type="number" min="0" step="100" name="price" class="form-control" value="{{$product->price}}" id="price">
    </div>
    <div class="col-md-3">
      <label for="sale" class="form-label">Giá khuyến mãi (nếu có)</label>
      <input type="number" min="0" step="100" name="sale" class="form-control" value="{{$product->sale}}" id="sale">
      @if (session('fail'))
          <div class="text-danger">{{session('fail')}}</div>
      @endif
    </div>
    <div class="col-md-4">
        <label for="inputState" class="form-label">Danh mục</label>
        <select id="inputState" name="category_id" class="form-select">
          <option selected class="fw-bold" value="{{\App\Models\Category::find($product->category_id)->id}}">{{\App\Models\Category::find($product->category_id)->name}}</option>
          @foreach (\App\Models\Category::getCategories() as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
          @endforeach
        </select>
      </div>
    <div class="col-md-2">
      <label for="warehouse" class="form-label">Kho hàng</label>
      <input type="number" min="0" name="warehouse" class="form-control" value="{{$product->warehouse}}" id="warehouse">
    </div>
    <div class="col-12">
      <label for="description" class="form-label">Mô tả</label>
      <input type="text" name="description" class="form-control" value="{{$product->description}}" id="description" placeholder="Thông tin sản phẩm">
    </div>
    
    <div class="col-12">
        <label for="image" class="form-label">Ảnh sản phẩm</label>
        <input class="form-control" name="image" type="file" id="image">
      </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
    </div>
</form>
@endsection