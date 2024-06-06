@extends('admin.layout.app')

@section('content')
<h3 class="mb-3">Thêm sản phẩm mới</h3>
        @if($errors->any())
        <ul>
        @foreach ($errors->all() as $error)
        <li style="color:red">{{$error}}</li>
        @endforeach
        </ul>
        @endif
<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="row g-3" >
    <div class="col-md-12">
      <label for="name" class="form-label">Tên sản phẩm</label>
      <input type="text" name="name" class="form-control" id="name">
    </div>
    <div class="col-md-3">
      <label for="price" class="form-label">Giá gốc</label>
      <input type="number" min="0" step="100" name="price" class="form-control" id="price">
    </div>
    <div class="col-md-3">
      <label for="sale" class="form-label">Giá khuyến mãi (nếu có)</label>
      <input type="number" min="0" step="100" name="sale" class="form-control" id="sale">
      @if (session('fail'))
          <div class="text-danger">{{session('fail')}}</div>
      @endif
    </div>
    <div class="col-md-4">
        <label for="inputState" class="form-label">Danh mục</label>
        <select id="inputState" name="category_id" class="form-select">
          <option selected>Chọn danh mục</option>
          @foreach (\App\Models\Category::getCategories() as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
          @endforeach
        </select>
      </div>
    <div class="col-md-2">
      <label for="warehouse" class="form-label">Kho hàng</label>
      <input type="number" min="0" name="warehouse" class="form-control" id="warehouse">
    </div>
    <div class="col-12">
      <label for="description" class="form-label">Mô tả</label>
      <input type="text" name="description" class="form-control" id="description" placeholder="Thông tin sản phẩm">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Ảnh sản phẩm</label>
        <input class="form-control" name="image" type="file" id="image">
      </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
    </div>
</form>
@endsection