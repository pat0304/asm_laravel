@extends('admin.layout.app')

@section('content')
    <h3>Danh mục</h3>
    @if (session('success'))
        <div class="alert alert-info" role="alert">
            {{session('success')}}
          </div>@endif
    @if (session('fail'))
        <div class="alert alert-danger" role="alert">
            {{session('fail')}}
          </div>@endif
    <div class="row">
        
        <div class="col-sm-9">
            <form action="{{route('categories.search')}}" method="POST" class="row g-3">
                @csrf
                <div class="col-sm-2">
                <select class="form-select " aria-label="Default select example" name="search_value">
                    <option value="id" selected>ID</option>
                    <option value="name">Tên</option>
                  </select>
                </div>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" placeholder="Tìm kiếm..." name="search_content">
                </div>
                <div class="col-sm-2">
                  <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
                </div>
              </form>
        </div>
        <div class="col-sm-3 text-end">
    <a href="{{route('categories.create')}}" class="btn btn-primary" >Thêm</a></div>
    </div>
    <table class="table table-striped table-responsive mt-4">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th class="text-center">Số lượng sản phẩm</th>
            <th>Hành động</th>
        </tr>
        @foreach ($categories as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td class="text-center">{{\App\Models\Product::where("category_id", "=", $item->id)->get()->count()}}</td>
            <td><a href="/admin/categories/{{$item->id}}/edit" class="btn btn-success"><i class="bi bi-arrow-repeat"></i></a>
                <form class="d-inline-block" method="POST" action="{{route('categories.destroy', $item->id)}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" onsubmit="return confirm('Xác nhận xóa danh mục')"><i class="bi bi-trash3-fill"></i></button>
                </form></td>
        </tr>
            
        @endforeach
    </table>
@endsection