@extends('user.layout.app')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-3 col-md-2 d-lg-block d-none" style="width: 225px">
            <!-- Hover added -->
            <h4 class="text-center mb-3">Danh mục</h4>
            @php
                $categories = \App\Models\Category::getCategories();
            @endphp
            <div class="list-group">
                @foreach ($categories as $i)
                    <a href="/products/category/{{$i->id}}" class="list-group-item list-group-item-action"
                    >{{$i->name}}</a
                >
                @endforeach
            </div>
        </div>
        <div class="col-lg-9 col">
            <h4 class="text-center">Sản phẩm</h4>
            
            <form id="sortForm" style="width: 150px; margin: 0 20px 0 auto" class="" method="get">
                <select name="sort" class="form-select form-select-sm mb-3" id="" onchange="this.form.submit()">
                    <option value="" selected>Sắp xếp</option>
                    <option value="increase">Giá tăng dần</option>
                    <option value="decrease">Giá giảm dần</option>
                    <option value="sale">Đang sale</option>
                </select>
                </form>
            <div class="row">
                @foreach ($data as $i)
        <div class="col-xl-4 col-md-6 mx-auto mb-2">
            <div class="card m-auto" style="width: 18rem;">
                <img src="{{$i->image}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $i->name }}</h5>
                  <div class="price mt-3 position-relative">
                  @if ($i->sale != null)
                  <div class="position-absolute" style="top: -10px; font-size: 12px">Giá gốc: <span class=" text-decoration-line-through">{{number_format($i->price,0, ',', '.')}}đ</span></div>
                  <h4 class="text-danger">{{number_format($i->sale,0, ',', '.')}}đ</h4>
                  @endif
                  @if ($i->sale == null)
                    <h4 class="">{{number_format($i->price,0, ',', '.')}}đ</h4>
                  @endif
                  
                </div>
                  <a href="/product/{{$i->id}}" class="btn btn-primary">Chi tiết</a>
                </div>
              </div>
        </div>
      @endforeach
            </div>
        </div>
    </div>
@endsection