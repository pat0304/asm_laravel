@extends('admin.layout.app')
@section('content')

    <header>
        <h1>Quản lý sản phẩm</h1>
        @if (session('success'))
        <div class="alert alert-info" role="alert">
            {{session('success')}}
          </div>@endif
        <div class="row">
        
            <div class="col-sm-9">
                <form action="{{route('products.search')}}" method="POST" class="row g-3">
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
        <a href="{{route('products.create')}}" class="btn btn-primary" >Thêm</a></div>
        </div>
        
    </header>
    <div class="container">
    <h3>Tất cả sản phẩm</h3>
    <table class="table">
    <thead>
        <tr>
            <th class="text-center">Ảnh minh họa</th>
            <th>Thông tin sản phẩm</th>
            <th class="text-center">Số lượng đã bán</th>
            <th class="text-center">Tồn kho</th>
            <th class="text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $i)
            @if($i->sale != null)
                <tr class="cart-item">
                <td class="">
                    <div style="background: url('{{url($i->image)}}');
                background-size: cover;
                background-position:center; height: 100px; width:100px; margin: auto"></div>
                </td>
                <td>
                    <h5>{{$i->name}}</h5>
                    <div class="text-decoration-line-through" style="font-size: 10px; margin-bottom: -10px">{{number_format($i->price, 0, ',', '.')}}</div>
                    <strong class="text-danger fs-5">{{number_format($i->sale, 0, ',', '.')}}</strong>
                    @php
                        $category = \App\Models\Category::findOrFail($i->category_id)->name;
                    @endphp
                    <p>Danh mục: <span class="fw-bold">{{$category}}</span></p>
                </td>
                <td class="py-5 fs-5 text-center fw-bold">50</td>
                <td class="py-5 fs-5 text-center fw-bold">{{$i->warehouse}}</td>
                <td class="py-5 fs-5 text-center fw-bold">
                    <a href="{{route('products.edit', $i->id)}}" class="btn btn-success"><i class="bi bi-arrow-repeat"></i></a>
                    <a href="{{route('products.destroy', $i->id)}}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a></td>

            </tr>
            @endif
            @if ($i->sale == null)
                
            <tr class="cart-item">
                <td class="">
                    <div style="background: url('{{url($i->image)}}');
                background-size: cover;
                background-position:center; height: 100px; width:100px; margin: auto"></div>
         a       </td>
                <td>
                    <h5>{{$i->name}}</h5>
                    
                    <strong class="fs-5">{{number_format($i->price, 0, ',', '.')}}</strong>
                    @php
                        $category = \App\Models\Category::findOrFail($i->category_id)->name;
                    @endphp
                    <p>Danh mục: <span class="fw-bold">{{$category}}</span></p>
                </td>
                <td class="py-5 fs-5 text-center fw-bold">50</td>
                <td class="py-5 fs-5 text-center fw-bold">{{$i->warehouse}}</td>
                <td class="py-5 fs-5 text-center fw-bold">
                    <a href="{{route('products.edit', $i->id)}}" class="btn btn-success"><i class="bi bi-arrow-repeat"></i></a>
                    <form class="d-inline-block" method="POST" action="{{route('products.destroy', $i->id)}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Xác nhận xóa sản phẩm {{$i->name}}?')"><i class="bi bi-trash3-fill"></i></button>
                    </form></td>

            </tr>        
            @endif
        @endforeach
    </tbody>
</table></div>
@endsection